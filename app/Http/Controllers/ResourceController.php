<?php

namespace App\Http\Controllers;

use App\Anka\Post;
use App\Helpers\Helper;
use App\Http\Requests\AnkaRequest;
use App\Models\Translation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class ResourceController extends Controller
{
    public function index(AnkaRequest $request)
    {
        $page = $request->page($request->resource);

        if ($page['withoutTable']) {
            return redirect()->route('edit', [$request->resource, 1]);
        }

        $fields = $request->fields($request->resource);

        $names = Helper::getFieldNames($fields);
        $labels = Helper::getFieldLabels($fields);

        $model = $page['model'];
        $mergedNames = array_merge($names, ['id']);
        $data = $model::select($mergedNames)->get();

        return view('admin.index', compact('page', 'data', 'labels', 'names'));
    }

    public function create(AnkaRequest $request)
    {
        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

        return view('admin.create', compact('page', 'fields'));
    }

    public function edit(AnkaRequest $request)
    {
        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

        $model = $page['model'];
        $data = $model::findOrFail($request->id);

        return view('admin.edit', compact('page', 'fields', 'data'));
    }

    public function translate(AnkaRequest $request)
    {
        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

        $model = $page['model'];
        $modelTableName = app($model)->getTable();

        $names = Helper::getAllFieldNames($fields);

        $data = [];
        foreach ($names as $name) {
            $data[$name] = Helper::getValueLang($modelTableName, $name, $request->id, $request->lang);
        }
        $data = array_merge($data, ['id' => $request->id]);


        return view('admin.edit', compact('page', 'fields', 'data'));
    }

    public function translateStore(AnkaRequest $request)
    {
        $data = $request->all();

        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

        $model = $page['model'];
        $modelTableName = app($model)->getTable();
        $names = Helper::getAllFieldNames($fields);


        if ($request->file()) {
            foreach ($request->file() as $key => $value) {
                $data[$key] = MediaController::image($value);
            }
        }

        // Slug Control
        $fieldsAttr = Helper::getFields($fields);
        foreach ($fieldsAttr as $item) {
            if ($item->slug == true) {
                $data[$item->name] = Str::slug($data[$item->name]);
            }
        }


        $data = Arr::only($data, $names);

        foreach ($data as $key => $value) {
            Translation::updateOrCreate([
                'table_name' => $modelTableName,
                'foreign_id' => $request->id,
                'column_name' => $key,
                'locale' => Helper::langId($request->lang)
            ], [
                'value' => $value,
            ]);
        }
        return back()->withInfo(__('wasUpdated', ['type' => $page['name']]));
    }

    public function update(AnkaRequest $request)
    {
        $data = $request->all();

        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

        $model = $page['model'];

        $names = Helper::getAllFieldNames($fields);

        // Slug Control
        $fieldsAttr = Helper::getFields($fields);
        foreach ($fieldsAttr as $item) {
            if ($item->slug == true) {
                $data[$item->name] = Str::slug($data[$item->name]);
            }
        }

        // File Control
        if ($request->file()) {
            foreach ($request->file() as $key => $value) {
                $data[$key] = MediaController::image($value);
            }
        }

        // Available fields
        $data = Arr::only($data, $names);

        try {
            $model::find($request->id)
                ->update($data);
            return redirect()->route('edit', [$request->resource, $request->id])->withInfo(__('wasUpdated', ['type' => $page['name']]));
        } catch (\Exception $e) {
            return back()->withInfo($e->getMessage());
        }
    }

    public function store(AnkaRequest $request)
    {
        $data = $request->all();
        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

        $model = $page['model'];

        $names = Helper::getAllFieldNames($fields);

        if ($request->file()) {
            foreach ($request->file() as $key => $value) {
                $data[$key] = MediaController::image($value);
            }
        }

        // Slug Control
        $fieldsAttr = Helper::getFields($fields);
        foreach ($fieldsAttr as $item) {
            if ($item->slug == true) {
                $data[$item->name] = Str::slug($data[$item->name]);
            }
        }

        $data = Arr::only($data, $names);

        try {
            $model::create($data);
            return redirect()->route('index', $request->resource)->withInfo(__('wasCreated', ['type' => $page['name']]));
        } catch (\Exception $e) {
            return back()->withInfo($e->getMessage());
        }
    }

    public function destroy(AnkaRequest $request)
    {
        $page = $request->page($request->resource);

        $model = $page['model'];
        $modelTableName = app($model)->getTable();
        $model::destroy($request->id);

        Translation::where('table_name', $modelTableName)
            ->where('foreign_id', $request->id)
            ->delete();

        return redirect()->route('index', $request->resource)->withInfo(__('wasDeleted', ['type' => $page['name']]));
    }
}
