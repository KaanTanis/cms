<?php
namespace App\Anka\Fields;

class Form{

    public static function make($card, $url = null, $method = 'POST')
    {
        return [
            'form' => $card,
            'url' => $url,
            'method' => $method
        ];
    }
}
