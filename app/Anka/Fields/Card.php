<?php

namespace App\Anka\Fields;

class Card {

    public static function make($form, $title = null)
    {
        return [
            'form' => $form,
            'title' => $title
        ];
    }
}
