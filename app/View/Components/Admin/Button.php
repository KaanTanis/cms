<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Button extends Component
{
    public $label;
    public $type;

    /**
     * Create a new component instance.
     *
     * @param $label
     * @param $type
     */
    public function __construct($label, $type)
    {
        $this->label = $label;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.button');
    }
}
