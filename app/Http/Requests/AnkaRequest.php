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
            'description' => $type::$description,
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
        $ankaPath = '\App\Anka';
        $ankaClass = Str::ucfirst(Str::camel($resource));

        return $ankaPath . '\\' . $ankaClass;
    }
}
