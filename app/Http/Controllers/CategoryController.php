<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\AnkaRequest;
use App\Models\Category;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CategoryController extends Controller
{
    public function index(AnkaRequest $request)
    {
        $fields = $request->fields($request->segment(2));
        $page = $request->page($request->segment(2));

        if ($page['withoutTable']) {
            return redirect('/admin/'.$page['slug'].'/create');
        }

        $data = Category::all();
        $labels = Helper::getFieldLabels($fields);
        $names = Helper::getFieldNames($fields);
        return view('admin.customIndex', compact('data', 'fields', 'page', 'labels', 'names'));
    }

    public function create(AnkaRequest $request)
    {
        $page = $request->page($request->segment(2));
        $fields = $request->fields($request->segment(2));
        return view('admin.customCreate', compact('page', 'fields'));
    }

    public function store(AnkaRequest $request)
    {
        Category::create(['name' => $request->name]);
        return back()->withInfo('Eklendi');
    }

    public function edit($id, AnkaRequest $request)
    {
        $fields = $request->fields($request->segment(2));
        $page = $request->page($request->segment(2));

        $data = Category::find($id);
        return view('admin.customEdit', compact('data', 'page', 'fields'));
    }

    public function update($id, AnkaRequest $request)
    {
        Category::find($id)->update([
            'name' => $request->name
        ]);
        return back()->withInfo('Kategori güncellendi');
    }

    public function translate(AnkaRequest $request)
    {
        $fields = $request->fields($request->segment(2));
        $page = $request->page($request->segment(2));

        $model = Category::class;
        $modelTableName = app($model)->getTable();

        $names = Helper::getAllFieldNames($fields);

        $data = [];
        foreach ($names as $name) {
            $data[$name] = Helper::getValueLang($modelTableName, $name, $request->id, $request->lang);
        }
        $data = array_merge($data, ['id' => $request->id]);

        return view('admin.customEdit', compact('data', 'page', 'fields'));
    }

    public function translateStore(AnkaRequest $request)
    {
        $data = $request->all();

        $fields = $request->fields($request->segment(2));
        $page = $request->page($request->segment(2));

        $model = Category::class;
        $modelTableName = app($model)->getTable();
        $names = Helper::getAllFieldNames($fields);


        if ($request->file()) {
            foreach ($request->file() as $key => $value) {
                $data[$key] = MediaController::image($value);
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

    public function destroy(AnkaRequest $request)
    {
        $page = $request->page($request->segment(2));

        $model = Category::class;
        $modelTableName = app($model)->getTable();
        $model::destroy($request->id);

        Translation::where('table_name', $modelTableName)
            ->where('foreign_id', $request->id)
            ->delete();

        return redirect('/admin/'.$page['slug'])->withInfo(__('wasDeleted', ['type' => $page['name']]));
    }

}
