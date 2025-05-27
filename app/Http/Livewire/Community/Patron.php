<?php

namespace App\Http\Livewire\Community;

use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Traits\LocalGovernmentTown;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class Patron extends Component
{
    use LocalGovernmentTown;
    public $member;
    public $patron;

    protected $rules = [
        'patron.payment_frequency' => 'str',
        'patron.no_of_slots' => 'int',
        'patron.town_id' => 'int',
    ];

    public function mount()
    {
        $this->member = Auth::guard('community')->user();

        if(!$this->member->patron)
        {
           return redirect()->to('/');
        }
    }

    public function generateReceipt($transaction_id)
    {
        $transaction = Transaction::find($transaction_id);
        $maintenance_transaction = Transaction::where('parent_id', $transaction_id)->first();

        $url = '';
        $data = [
            'patron_name' => $transaction->member->getFullNameAttribute(),
            'no_of_slots' => $transaction->amount / config('app.scholarship_cost'),
            'created_at' => $transaction->created_at,
            'items' => [
                ['description' => 'Contribution', 'price' => $transaction->amount - $maintenance_transaction->amount],
                ['description' => 'Maintenance', 'price' => $maintenance_transaction->amount],
            ],
            'total' => $transaction->amount,
        ];

        $formatNumber = function ($argument)
        {
            $formatter = new \NumberFormatter('en', \NumberFormatter::CURRENCY);
            $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
            return $formatter->formatCurrency($argument, 'NGN');
        };

        // Generate PDF using Dompdf
        $pdf = PDF::loadView('pdfs.receipt', compact('data', 'url', 'formatNumber'));

        return response()->streamDownload(function () use($pdf) {
            echo  $pdf->output();
        }, 'report.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="report.pdf"',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Pragma' => 'public',
            'Access-Control-Allow-Origin' => '*',
            'Content-Length' => strlen($pdf->output()),
        ]);
    }

    public function activate(bool $enabled) {
        $this->patron->is_active = $enabled;
        $this->patron->save();
        $this->dispatchBrowserEvent('success', 'Update successful');
    }

    public function saveUpdate() {
        $this->patron->save();
        $this->dispatchBrowserEvent('success', 'Update successful');
    }

    public function render()
    {
        $this->member = Auth::guard('community')->user();

        $towns = (isset($this->member->local_government)) ? $this->towns($this->member->local_government_id) : [];

        $results = $this->member->examResults;

        $this->patron = $this->member->patron;

        $formatNumber = function ($argument)
        {
            $formatter = new \NumberFormatter('en', \NumberFormatter::CURRENCY);
            $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
            return str_replace('NGN', '₦', $formatter->formatCurrency($argument, 'NGN'));
        };

        title('Community Member Results');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.community.patron', compact('results', 'towns', 'formatNumber', ))
            ->extends('layouts.community')
            ->section('content');
    }
}