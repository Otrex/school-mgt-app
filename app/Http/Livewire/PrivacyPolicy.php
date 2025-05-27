<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.privacy-policy')
            ->extends('layouts.app')
            ->section('content');
    }
}
