<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableData extends Component
{
    public $name;

    public $target;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "", $target="search")
    {
        $this->name = $name;
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table-data');
    }
}
