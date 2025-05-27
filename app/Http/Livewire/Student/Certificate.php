<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class Certificate extends Component
{
    public function render()
    {
        title('Student Certificate');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.student.certificate')
            ->extends('layouts.user')
            ->section('content');
    }
}
