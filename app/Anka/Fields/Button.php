<?php

namespace App\Anka\Fields;

class Button extends Fields {

    public $component = 'button-field';

    public $hideFromIndex = true;

    public $onEdit;

    public function onEdit($onEdit)
    {
        $this->onEdit = $onEdit;
        return $this;
    }
}
