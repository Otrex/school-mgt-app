<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use Livewire\Component;

class Index extends Component
{
    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = ['render'];

    public function delete($id)
    {
        if (isset($id)) {
            $blog = Blog::find($id);

            $blog->delete();

            $this->emit('render');

            $this->dispatchBrowserEvent('success', 'Blog post deleted successfully!');
        }
    }

    public function render()
    {
        $blog_count = Blog::count();

        $category_count = Blog::all()->unique('category')->values()->all();

        $search = Blog::query();

        $blogs = $search->where(function($query) {
            $query->where('title', 'like', $this->search.'%')
            ->orWhere('category', 'like', $this->search.'%');
        })
        ->latest()
        ->paginate();

        title('Admin - All Blog Post');

        return view('livewire.admin.blog.index', compact('blog_count', 'category_count', 'blogs'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
