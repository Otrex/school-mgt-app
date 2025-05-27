<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class BlogDetail extends Component
{
    public Blog $blog;

    public function render()
    {
        title($this->blog->title);
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.blog-detail')
            ->extends('layouts.app')
            ->section('content');
    }
}
