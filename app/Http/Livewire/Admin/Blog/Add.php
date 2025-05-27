<?php

namespace App\Http\Livewire\Admin\Blog;

use Livewire\Component;
use App\Traits\MediaUpload;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads, MediaUpload;

    public $title;

    public $summary;

    public $content;

    public $category;

    public $tags;

    public $keywords;

    public $is_publish;

    public $image;

    protected $rules = [
        'title' => 'required|string',
        // 'summary' => 'required|string',
        'content' => 'required|string',
        // 'category' => 'required|string',
        'is_publish' => 'required',
        'image' => 'required',
    ];

    public function add()
    {
        $this->validate();

        $image = $this->uploadSingleImage($this->image);

        $slug = Str::slug($this->title);

        // add new blog post
        auth('admin')->user()->blogs()->create([
            'title' => $this->title,
            // 'summary' => $this->summary,
            'content' => $this->content,
            // 'category' => 'blog',
            'tags' => $this->tags,
            'keywords' => $this->keywords,
            'is_publish' => $this->is_publish,
            'image' => $image,
            'slug' => $slug,
        ]);

        // success alert message
        $this->dispatchBrowserEvent('success', 'New blog post created successfully');

        // reset form
        $this->reset([
            'title',
            // 'summary',
            'content',
            // 'category',
            'tags',
            'keywords',
            'is_publish',
            'image',
        ]);
    }

    public function render()
    {
        title('Admin - Add Blog Post');

        return view('livewire.admin.blog.add')
            ->extends('layouts.admin')
            ->section('content');
    }
}