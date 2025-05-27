<?php

namespace App\Http\Livewire\Community;

use Livewire\Component;

class VoucherService extends Component
{
    public function render()
    {
        title('Voucher Merchant');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.community.voucher-service')
            ->extends('layouts.community')
            ->section('content');
    }
}
