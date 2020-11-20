<?php

namespace App\Anka\Fields;

class Text {

    public static function make($name)
    {
        return (new static)->name($name);
    }

    public static function placeholder($placeholder)
    {
        return $placeholder;
    }

    private function name($name)
    {
        return $name;
    }


}
