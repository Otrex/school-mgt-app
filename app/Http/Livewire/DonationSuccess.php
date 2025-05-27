<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DonationSuccess extends Component
{
    public function render()
    {
        title('Thank you for donating to our cause');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.donation-success')
            ->extends('layouts.message')
            ->section('content');
    }
}
