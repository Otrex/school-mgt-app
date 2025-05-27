<?php

namespace App\Http\Livewire\Components;

use App\Models\Community;
use App\Models\Patron;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BecomePatronButton extends Component
{
    public $member;

    protected $listeners = [
        'refresh_btn_patron' => 'render'
    ];

    public function render()
    {
        Log::debug("rerendering");
        $this->member = auth('community')->user();

        // $patron = Patron::where('');


        return view('livewire.components.become-patron-button', [
            "patron" => $this->member->patron
        ]);
    }
}