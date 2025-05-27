<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Success extends Component
{
    public function render()
    {
        title('Transaction Successful');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.success')
            ->extends('layouts.message')
            ->section('content');
    }
}