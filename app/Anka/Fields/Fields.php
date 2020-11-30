<?php

namespace App\Anka\Fields;

class Fields
{
    public static function make($label = null, $name = null)
    {
        return (new static)
            ->label($label)
            ->name($name);
    }

    public $name;
    public $placeholder;
    public $label;
    public $required;
    public $value;
    public $type;
    public $rows;
    public $hideFromIndex;

    public function label($label)
    {
        $this->label = $label;
        return $this;
    }

    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    public function rows($rows)
    {
        $this->rows = $rows;
        return $this;
    }

    public function hideFromIndex($val = true)
    {
        $this->hideFromIndex = $val;
        return $this;
    }

    public function required()
    {
        $this->required = true;
        return $this;
    }

}
