<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * @var string
     */
    public $method;
    /**
     * @var string
     */
    public $url;

    /**
     * Create a new component instance.
     *
     * @param $url
     * @param $method
     */
    public function __construct($url, $method = 'POST')
    {
        $this->url = $url;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.form');
    }
}
