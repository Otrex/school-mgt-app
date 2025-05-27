<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $name;

    public $target;

    public $spinner_color;

    /**
     * Create a new component instance.
     */
    public function __construct($name='', $target='', $spinner_color='light')
    {
        $this->name = $name;

        $this->target = $target;

        $this->spinner_color = $spinner_color;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
