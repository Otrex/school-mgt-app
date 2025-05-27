<?php

namespace App\Http\Livewire\Admin\Course;

use App\Models\Course;
use App\Models\CourseCategory;
use Livewire\Component;
use App\Traits\MediaUpload;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads, MediaUpload;

    public $name;

    public $summary;

    public $fee = 0;

    public $bill_type;

    public $category;

    public $sub_category;

    public $duration;

    public $image;

    protected array $rules = [
        'name' => 'required|string',
        'summary' => 'required|string|max:5000',
        'fee' => 'required|numeric',
        'bill_type' => 'required|string',
        'category' => 'required|string',
        'sub_category' => 'string',
        'duration' => 'required|string',
        'image' => 'required',
    ];

    public function openEditor()
    {
        $this->dispatchBrowserEvent('openEditor');
    }

    public function updated($propName = 'summary')
    {
        $this->validateOnly($propName);
    }

    public function add()
    {
        $this->withValidator(function(Validator $validator) {
            $validator->after(function($validator) {
                if ($this->bill_type == "Paid" && $this->fee == 0)
                    $validator->errors()->add('fee', 'This program fee is invalid for a paid program');

                if ($this->bill_type == "Free" && $this->fee > 0)
                    $validator->errors()->add('fee', 'This program fee is invalid for a free program');
            });
        })->validate();

        $image = $this->uploadSingleImage($this->image);

        // unique hash string to attach at the slug
        $hash_str = substr(md5(uniqid()), 0, 12);

        $course = Course::create([
            'name' => $this->name,
            'summary' => $this->summary,
            'fee' => $this->fee,
            'bill_type' => $this->bill_type,
            'course_category_id' => $this->sub_category ? $this->sub_category :$this->category,
            'duration' => $this->duration,
            'image' => $image,
            'slug' => Str::slug($this->name)."-".$hash_str,
        ]);

        $this->dispatchBrowserEvent("success", "New program added successfully!");

        $this->reset([
            'name',
            'summary',
            'fee',
            'bill_type',
            'category',
            'duration',
            'image',
        ]);

        return redirect()->route('admin.course.view', $course);
    }

    public function render()
    {
        $categories = CourseCategory::all();
        $sub_categories = CourseCategory::where('parent_category_id', $this->category)->get();

        title('Admin - Add Program');

        return view('livewire.admin.course.add', compact('categories', 'sub_categories'))
            ->extends('layouts.admin')
            ->section('content');
    }
}