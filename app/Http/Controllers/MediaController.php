<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{
    public static function image($image)
    {
        $name = uniqid().'.'.$image->getClientOriginalExtension();
        try {
            $image = Image::make($image);
            $image->save(public_path('storage/uploads/'.$name), 80);
        } catch (\Exception $e) {
            $image->move(public_path('storage/uploads'), $name);
        }

        return $name;
    }

}
