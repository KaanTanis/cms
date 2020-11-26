<?php

namespace App\Http\Controllers;

use App\Anka\Post;
use App\Http\Requests\AnkaRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(AnkaRequest $request)
    {
        $fields = $request->fields($request->resource);
        $page = $request->page($request->resource);

        return view('admin.create', compact('page', 'fields'));
    }

    public function store(AnkaRequest $request)
    {
        // modeli bul
        $page = $request->page($request->resource);

        $model = $page['model'];
        $name = $page['name'];

        try {
            $model::create($request->all());
            return back()->withInfo(__('wasCreated', ['type' => $name]));
        } catch (\Exception $e) {
            return back()->withInfo($e->getMessage());
        }
    }
}
