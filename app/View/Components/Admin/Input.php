<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $name;
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @param $label
     * @param $name
     * @param $placeholder
     */
    public function __construct($label, $name, $placeholder)
    {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
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
