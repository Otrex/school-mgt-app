<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\CourseContentsLanguages;

class EditLanguage extends Component
{
    public CourseContentsLanguages $ContentLanguage;


    public $disable;

    protected $rules = [
        'ContentLanguage.language' => 'required|string',

        'ContentLanguage.disable' => 'required'
    ];

    public function save()
    {
        $this->validate();

        $this->ContentLanguage->save();

        $this->dispatchBrowserEvent('success', 'Course Content Language  updated successfully!');
    }
    public function render()
    {
        return view('livewire.admin.setting.edit-language')
        ->extends('layouts.admin')
        ->section('content');
    }
}
