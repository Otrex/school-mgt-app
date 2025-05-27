<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CurrencyFormat extends Component
{
    public $amount;
    public $formatted_amount;

    public function render()
    {
        $formatter = new \NumberFormatter('en', \NumberFormatter::CURRENCY);
        $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);

        $this->formatted_amount = str_replace('NGN', '₦', $formatter->formatCurrency($this->amount, 'NGN'));

        return <<<'HTML'
        <span>
            {{ $formatted_amount }}
        </span>
        HTML;
    }
}