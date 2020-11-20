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

    public function name($resource)
    {
        return $this->getAnkaClass($resource)::$name;
    }

    public function table($resource)
    {
        return $this->getAnkaClass($resource)::$table;
    }

    public function fields($resource)
    {
        $type = $this->getAnkaClass($resource);
        // todo: rules ile alanları sorgula
        return $type::fields();
    }

    public function getAnkaClass($resource)
    {
        $ankaPath = '\App\Anka';
        $ankaClass = $this->strClassName($resource);
        return $ankaPath . '\\' . $ankaClass;
    }

    public function strClassName($name)
    {
        return Str::ucfirst(Str::camel($name));
    }
}
