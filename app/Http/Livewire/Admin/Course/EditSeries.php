<?php

namespace App\Http\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\CourseSeries;
use App\Models\CourseContent;
use App\Models\CourseContentsLanguages;
use Illuminate\Validation\Validator;

class EditSeries extends Component
{
    public CourseSeries $series;

    public Course $course;

     public $video_content;
     public $text_content;
     public $summary;
     public $title;
     public $language;


     public $search;
 


    protected $rules = [
        'series.serial_no' => 'required|numeric',
        'series.title' => 'required|string',
        'series.summary' => 'required|string',
        'series.text_content' => 'required|string',
        'series.video_content' => 'required',
    ];
    protected $listeners = ['refresh' => 'render'];
    public function updateSeries()
    {
        $this->validate();

        $this->series->slug = Str::slug($this->series->title);

        $this->series->save();

        $this->dispatchBrowserEvent('success', "Program series updated successfully!");
    }



    public function addSeriesContent()
    {

        $this->withValidator(function(Validator $validator) {
            $validator->after(function($validator) {
                if (CourseContent::where([
                    'course_series_id'=>$this->series->id,'course_contents_languages_id' => $this->language
                   ])->exists()) 
                    $validator->errors()->add('language', 'This language has already been added, please select a new language');
                 
            });
        })->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'text_content' => 'required|string',
        ],);



       

        // unique hash string to attach at the slug
        $hash_str = substr(md5(uniqid()), 0, 12);

        $slug = Str::slug($this->title)."-".$hash_str;

        CourseContent::create([
            'course_series_id' => $this->series->id,
            'course_contents_languages_id' => $this->language,
            'title' => $this->title,
            'summary' => $this->summary,
            'text_content' => $this->text_content,
            'video_content' => $this->video_content,
            'slug' => $slug,
        ]);

        $this->dispatchBrowserEvent('success', "Program Content added successfully!");

        $this->emit('refresh');

        $this->reset([
            'language',
            'title',
            'summary',
            'text_content',
            'video_content',
        ]);
    }

    
    public function delete($id)
    {
        if (isset($id)) {
            $course = CourseContent::find($id);

            $course->delete();

            $this->dispatchBrowserEvent('closeModal', ['id' => $id]);

            $this->dispatchBrowserEvent('success', 'Course Content deleted successfully!');

            $this->emit('refresh');

            $this->reset([
                'language',
                'title',
                'summary',
                'text_content',
                'video_content',
            ]);
        }
    }




    public function render()
    {
        $content = $this->series->courseContent;

        $languages = CourseContentsLanguages::all();

        title('Admin - Edit Program Lesson');

        return view('livewire.admin.course.edit-series',[
            'content' => $content,
            'languages' => $languages
            ])
            ->extends('layouts.admin')
            ->section('content');
    }
}
