<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{
    public static function image($image, $quality = NULL, $width = NULL, $height = NULL)
    {
        $name = uniqid();
        $extension = $image->getClientOriginalExtension();
        $image = Image::make($image);
        if ($width != NULL || $height != NULL) {
            $image->fit($width, $height, function ($fit) {
                $fit->aspectRatio();
                $fit->upsize();
            });
        }
        $image->save(public_path('storage/uploads/'.$name.'.'.$extension), $quality);
        return $name.'.'.$extension;
    }

    /**
     * @param $video
     * @return string
     */
    public static function video($video)
    {
        $name = uniqid().'.'.$video->getClientOriginalExtension();
        $video->move(public_path('storage/uploads'), $name);
        return $name;
    }
}
