<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CommunityAbout extends Component
{
    public function render()
    {
        title('About Community Membership');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.community-about')
            ->extends('layouts.app')
            ->section('content');
    }
}
