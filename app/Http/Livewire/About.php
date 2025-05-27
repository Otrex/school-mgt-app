<?php

namespace App\Http\Livewire;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        title('About Us');

        return view('livewire.about')
            ->extends('layouts.app')
            ->section('content');
    }
}
