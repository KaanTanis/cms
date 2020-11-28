<?php

namespace App\Http\Controllers;

use App\Anka\Post;
use App\Helpers\Helper;
use App\Http\Requests\AnkaRequest;
use App\Models\Translation;
use App\Models\User;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(AnkaRequest $request)
    {
        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

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

        $names = Helper::getFieldNames($fields);

        $data = [];
        foreach ($names as $name) {
            $data[$name] = Helper::getValueLang($modelTableName, $name, $request->id, $request->lang);
        }
        $data = array_merge($data, ['id' => $request->id]);


        return view('admin.edit', compact('page', 'fields', 'data'));
    }

    public function translateStore(AnkaRequest $request)
    {
        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

        $model = $page['model'];
        $modelTableName = app($model)->getTable();
        $names = Helper::getFieldNames($fields);
        foreach ($request->only($names) as $key => $value) {
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
        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

        $model = $page['model'];

        $names = Helper::getFieldNames($fields);

        try {
            $model::find($request->id)
                ->update($request->only($names));
            return redirect()->route('index', $request->resource)->withInfo(__('wasUpdated', ['type' => $page['name']]));
        } catch (\Exception $e) {
            return back()->withInfo($e->getMessage());
        }
    }

    public function store(AnkaRequest $request)
    {
        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

        $model = $page['model'];

        $names = Helper::getFieldNames($fields);

        try {
            $model::create($request->only($names));
            return redirect()->route('index', $request->resource)->withInfo(__('wasCreated', ['type' => $page['name']]));
        } catch (\Exception $e) {
            return back()->withInfo($e->getMessage());
        }
    }

    public function destroy(AnkaRequest $request)
    {
        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

        $model = $page['model'];
        $modelTableName = app($model)->getTable();
        $data = $model::destroy($request->id);

        Translation::where('table_name', $modelTableName)
            ->where('foreign_id', $request->id)
            ->delete();

        return redirect()->route('index', $request->resource)->withInfo(__('wasDeleted', ['type' => $page['name']]));
    }
}
