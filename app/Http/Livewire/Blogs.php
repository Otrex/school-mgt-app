<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class Blogs extends Component
{
    public function render()
    {
        $blogs = Blog::all();

        title('Blog');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.blogs', compact('blogs'))
            ->extends('layouts.app')
            ->section('content');
    }
}
