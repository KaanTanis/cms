<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $label;
    public $name;
    public $placeholder;
    public $rows;

    /**
     * Create a new component instance.
     *
     * @param $label
     * @param $name
     * @param $placeholder
     * @param $rows
     */
    public function __construct($label, $name, $placeholder, $rows)
    {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.textarea');
    }
}
