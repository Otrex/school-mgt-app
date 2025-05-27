<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\CourseContentsLanguages;

class Languages extends Component
{

    public $language;

    public $disable;

    protected $rules = [
        'language' => 'required|string|unique:course_contents_languages',
        'disable' => 'required'
    ];

    public function addContentLanguage()
    {
        $this->validate();

        CourseContentsLanguages::create([
            'language' => $this->language,
            'disable' => $this->disable
        ]);

        $this->dispatchBrowserEvent('success', 'New Course Content Language added');

        $this->reset(['language']);
    }
    public function render()
    {
        return view('livewire.admin.setting.languages')
        ->extends('layouts.admin')
        ->section('content');
    }
}
