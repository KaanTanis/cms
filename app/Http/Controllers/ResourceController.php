<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnkaRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(AnkaRequest $request)
    {
        dd($request->fields($request->resource));

        User::all();
    }
}
