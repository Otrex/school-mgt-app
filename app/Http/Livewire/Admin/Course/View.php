<?php

namespace App\Http\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;
use App\Traits\MediaUpload;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\CourseCategory;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class View extends Component
{
    use WithFileUploads, MediaUpload;

    public Course $course;

    public $image;

    public $serial_no;

    public $title;

    public $summary;

    public $content;

    protected array $rules = [
        'course.name' => 'required|string',
        'course.summary' => 'required|string',
        'course.fee' => 'required|numeric',
        'course.bill_type' => 'required|string',
        'course.duration' => 'required|string',
        'course.course_category_id' => 'required',
    ];

    protected $messages = [
        'course.course_category_id.required' => 'Course category is required',
        'course.course_category_id.string' => 'Course category is required'
    ];

    protected $listeners = ['refresh' => 'render'];

    public function save()
    {
        $this->validate();

        // unique hash string to attach at the slug
        $hash_str = substr(md5(uniqid()), 0, 12);

        // update slug on change to course name changes
        $this->course->slug = Str::slug($this->course->name)."-".$hash_str;

        $this->course->save();

        $this->dispatchBrowserEvent("success", "Course detail updated!");
    }

    public function uploadNewImage()
    {
        $this->validate(['image' => 'required']);

        // upload new image to the disk and retrieve the image name
        $this->course->image = $this->uploadSingleImage($this->image);

        // save image to model
        $this->course->save();

        $this->emit('refresh');

        // reset input file form
        $this->reset(['image']);

        // flash success message
        $this->dispatchBrowserEvent('success', 'New course image uploaded');
    }

    public function removeImage()
    {
        if(env('APP_ENV') == 'local')
            // delete from file storage system
            Storage::disk('public')->delete("course/{$this->course->image}");

        $this->course->image = '';

        $this->course->save();

        $this->emit('refresh');

        $this->dispatchBrowserEvent('success', 'Image removed successfully!');
    }

    public function addSeries()
    {
        $serial_no_arrs = $this->course->courseSeries->pluck('serial_no')->toArray();

        // custom message
        $messages = [
            'serial_no.not_in' => 'This serial number has already been used'
        ];

        $this->validate([
            'serial_no' => 'required|numeric|'.Rule::notIn($serial_no_arrs),
            'title' => 'required|string',
            'summary' => 'required|string',
        ], $messages);

        // unique hash string to attach at the slug
        $hash_str = substr(md5(uniqid()), 0, 12);

        $slug = Str::slug($this->title)."-".$hash_str;

        $this->course->courseSeries()->create([
            'serial_no' => $this->serial_no,
            'title' => $this->title,
            'summary' => $this->summary,
            'slug' => $slug,
        ]);

        $this->dispatchBrowserEvent('success', "Course series {$this->serial_no} added successfully!");

        $this->emit('refresh');

        $this->reset([
            'serial_no',
            'title',
            'summary',
        ]);
    }

    public function delete($id)
    {
        if (isset($id)) {
            $series = $this->course->courseSeries()->where('id', $id)->first();

            $series->delete();

            $this->dispatchBrowserEvent('success', 'Series deleted successfully!');
        }
    }

    public function render()
    {
        $categories = CourseCategory::all();

        $course_series = $this->course->courseSeries()->orderBy('serial_no')->get();
        title('Admin - View Program ('.$this->course->name.')');

        return view('livewire.admin.course.view', compact('categories', 'course_series'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
