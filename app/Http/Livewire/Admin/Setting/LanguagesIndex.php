<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CourseContentsLanguages;

class LanguagesIndex extends Component
{

    use WithPagination;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function delete($id)
    {
        if (isset($id)) {
            $series_language = CourseContentsLanguages::find($id);

            $series_language->delete();

            $this->dispatchBrowserEvent('closeModal', ['id' => $id]);

            $this->dispatchBrowserEvent('success', 'Course Content Language  deleted successfully!');
        }
    }

    public function render()
    {

        $search = CourseContentsLanguages::query();

        $series_language = $search->where(function($query) {
            $query->where('language', 'like', '%'.$this->search.'%');
        })->latest()->paginate();

        $course_language_count = CourseContentsLanguages::count();

        title('Admin - All Course Content Language ');

        return view('livewire.admin.setting.languages-index', compact('series_language', 'course_language_count'))
        ->extends('layouts.admin')
        ->section('content');
    }
}
