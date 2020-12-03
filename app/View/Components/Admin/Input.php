<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $name;
    public $placeholder;
    public $value;
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @param $label
     * @param $name
     * @param $placeholder
     * @param $value
     * @param $disabled
     */
    public function __construct($label, $name, $placeholder, $value, $disabled = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.input');
    }
}
