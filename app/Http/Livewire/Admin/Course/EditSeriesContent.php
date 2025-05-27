<?php

namespace App\Http\Livewire\Admin\Course;
use App\Models\CourseSeries;
use App\Models\CourseContent;
use App\Models\Course;
use Illuminate\Support\Str;
use App\Models\CourseContentsLanguages;



use Livewire\Component;

class EditSeriesContent extends Component
{
    

    public Course $course;
    public CourseSeries $series;
    public CourseContent $series_content;
    public $serial_no;
    public $language;


    public $video_content;
    public $text_content;
    public $summary;

    public $title;

    protected $rules = [
        'series_content.video_content' => 'required|string',
        'series_content.title' => 'required|string',
        "series_content.summary" => "required|string",
        "series_content.text_content" => "required|string",
        "series_content.video_content" => "required|string",
        'series_content.course_contents_languages_id' => 'required',
     ];
     protected $listeners = ['refresh' => 'render'];

     public function updateSeriesContent()
     {
        
         $this->series_content->slug = Str::slug($this->series_content->title);
 
         $this->series_content->save();
         $this->emit('refresh');
        
         $this->reset([
            'language',
            'title',
            'summary',
            'text_content',
            'video_content',
        ]);
         $this->dispatchBrowserEvent('success', "All lesson content updated successfully!");
     }

    public function render()
    {

        $languages = CourseContentsLanguages::all();
     
        title('Admin - Edit Content Lesson');

        return view('livewire.admin.course.edit-series-content', compact('languages'))
        ->extends('layouts.admin')
        ->section('content');
    }
}
