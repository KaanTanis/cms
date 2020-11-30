<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class File extends Component
{
    public $label;
    public $name;
    public $value;

    /**
     * Create a new component instance.
     *
     * @param $label
     * @param $name
     * @param $value
     */
    public function __construct($label, $name, $value)
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.file');
    }
}
