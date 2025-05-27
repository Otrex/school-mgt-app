<?php

namespace App\Http\Livewire\Community;

use Livewire\Component;

class Certificate extends Component
{
    public function render()
    {
        title('Community Member Certificate');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.community.certificate')
            ->extends('layouts.community')
            ->section('content');
    }
}
