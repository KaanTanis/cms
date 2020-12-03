<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class AnkaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function page($resource)
    {
        $type = $this->getAnkaClass($resource);

        return [
            'model' => $type::$model,
            'name' => $type::$name,
            'nameIndex' => $type::$nameIndex,
            'description' => $type::$description,
            'translatable' => $type::$translatable,
            'withoutTable' => $type::$withoutTable,
            'hideFromSidebar' => $type::$hideFromSidebar,
            'slug' => $type::$slug
        ];
    }

    public function fields($resource)
    {
        // todo: post işleminde rules ile alanları sorgula
        $type = $this->getAnkaClass($resource);
        return $type::fields();
    }

    public function getAnkaClass($resource)
    {
        $ankaPath = '\App\Anka'; // prefix
        $newPath = null;
        foreach (glob(app_path('/Anka/*.php')) as $item) { // get all classes
            $ankaClass = basename($item, '.php'); // get class name
            $path = $ankaPath . '\\' . $ankaClass; // get spesific class

            $vars = get_class_vars($path); // get all vars
                if ($resource == $vars['slug']) { // check $slug on resource
                    $newPath = $path; // create new path
                }
        }

        return class_exists($newPath) ? $newPath : abort(404);
    }
}
