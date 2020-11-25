<?php

namespace App\Anka\Fields;

class Card {

    public static function make($fields, $title = null)
    {
        return ['card' => $fields, 'title' => $title];
    }
}
