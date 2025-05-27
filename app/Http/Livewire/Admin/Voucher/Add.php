<?php

namespace App\Http\Livewire\Admin\Voucher;

use App\Models\Voucher;
use Livewire\Component;
use Illuminate\Support\Str;

class Add extends Component
{
    public $price;

    public $quantity;

    protected $rules = [
        'price' => 'required|numeric',
        'quantity' => 'required|numeric',
    ];

    public function generate()
    {
        $this->validate();

        for ($i=1; $i <= $this->quantity; $i++) {
            $code = strtoupper(Str::random(11));

            Voucher::create([
                'price' => $this->price,
                'quantity' => $this->quantity,
                'code' => $code
            ]);
        }

        $this->dispatchBrowserEvent('success', "{$this->quantity} voucher generated successfully!");

        $this->reset(['price', 'quantity']);
    }

    public function render()
    {
        title('Admin - Generate Voucher');

        return view('livewire.admin.voucher.add')
            ->extends('layouts.admin')
            ->section('content');
    }
}
