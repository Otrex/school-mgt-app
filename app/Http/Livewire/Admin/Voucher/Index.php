<?php

namespace App\Http\Livewire\Admin\Voucher;

use App\Models\Voucher;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $price;

    public $voucher_status;

    public function filter()
    {
        $vouchers = null;

        $filter = Voucher::query();

        // by price
        if (isset($this->price)) {
            $vouchers = $filter->where('price', $this->price);
        }

        // voucher status
        if (isset($this->voucher_status)) {
            $vouchers = $filter->where('is_used', $this->voucher_status);
        }

        if (isset($this->price) || isset($this->voucher_status)) {
            $vouchers = $vouchers->latest()->paginate();
        }

        return $vouchers;
    }

    public function resetFilter()
    {
        $this->reset(['price', 'voucher_status']);
    }

    public function render()
    {
        $vouchers = (isset($this->price) || isset($this->voucher_status)) ?
            $this->filter() : Voucher::latest()->paginate();

        $vouchers_count = Voucher::count();

        $used = Voucher::where('is_used', true)->get();

        $un_used = Voucher::where('is_used', false)->get();

        $voucher_prices = Voucher::all('price')->unique('price')->values()->all();

        $mask = fn($price) => Str::mask($price, '*', 0);

        title('Admin - All Vouchers');

        return view('livewire.admin.voucher.index', compact(
                'vouchers', 'used', 'un_used', 'vouchers_count',
                'voucher_prices', 'mask'
            ))
            ->extends('layouts.admin')
            ->section('content');
    }
}
