<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use Livewire\Component;
use App\Traits\MediaUpload;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class View extends Component
{
    use WithFileUploads, MediaUpload;

    public Blog $blog;

    public $image;

    protected $rules = [
        'blog.title' => 'required|string',
        'blog.summary' => 'required|string',
        'blog.content' => 'required|string',
        'blog.category' => 'required|string',
        'blog.is_publish' => 'required',
        'blog.tags' => '',
        'blog.keywords' => '',
    ];

    protected $listeners = ['refresh' => 'render'];

    public function save()
    {
        $this->validate();

        $this->blog->slug = Str::slug($this->blog->title);

        $this->blog->save();

        $this->dispatchBrowserEvent('success', 'Blog post updated');
    }

    public function uploadNewImage()
    {
        $this->validate(['image' => 'required']);

        // upload new image to the disk and retrieve the image name
        $this->blog->image = $this->uploadSingleImage($this->image);

        // save image to model
        $this->blog->save();

        $this->emit('refresh');

        // reset input file form
        $this->reset(['image']);

        // flash success message
        $this->dispatchBrowserEvent('success', 'New blog image uploaded');
    }

    public function removeImage()
    {
        $this->blog->image = '';

        $this->blog->save();

        $this->dispatchBrowserEvent('success', 'Image removed successfully!');
    }

    public function render()
    {
        title('Admin - View Blog Post ('.$this->blog->title.')');

        return view('livewire.admin.blog.view')
            ->extends('layouts.admin')
            ->section('content');
    }
}
