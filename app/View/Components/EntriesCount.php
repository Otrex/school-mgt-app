<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EntriesCount extends Component
{
    public $collection;

    public $class;

    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($collection, $class = null, $title = null)
    {
        $this->collection = $collection;
        $this->class = $class;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.entries-count');
    }
}
