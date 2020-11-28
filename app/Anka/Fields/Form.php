<?php
namespace App\Anka\Fields;

class Form{

    public static function make($fields, $url = null, $method = 'POST')
    {
        return [
            'fields' => $fields,
            'url' => $url,
            'method' => $method
        ];
    }
}
