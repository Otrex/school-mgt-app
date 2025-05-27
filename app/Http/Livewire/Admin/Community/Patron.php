<?php

namespace App\Http\Livewire\Admin\Community;

use App\Enums\TransactionSource;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Community;
use App\Models\ScholarshipSlot;
use App\Models\Transaction;
use App\Models\Patron as PatronModel;
use Livewire\Component;
use App\Traits\LocalGovernmentTown;
use Livewire\WithPagination;

class Patron extends Component
{
    use LocalGovernmentTown, WithPagination;

    public $search_name;
    public $search_town;
    public $current_patron;
    public $totals = [
        'patron_contribution' => 0,
        'allocated_scholarship' => 0,
        'maintenance_funds' => 0,
    ];

    public function getTotals()
    {
        $this->totals['patron_contribution'] = Transaction::where('type', TransactionType::CREDIT)
            ->where('source', TransactionSource::CONTRIBUTION)
            ->where('status', TransactionStatus::COMPLETED)
            ->sum('amount') ?? 0;

        $this->totals['maintenance_funds'] = Transaction::where('type', TransactionType::CREDIT)
            ->where('source', TransactionSource::MAINTENANCE)
            ->where('status', TransactionStatus::COMPLETED)
            ->sum('amount') ?? 0;

        $this->totals['allocated_scholarship'] = ScholarshipSlot::whereNotNull('beneficiary_id')->count();

    }

    public function view_patron($id)
    {
        $this->getTotals();
        $this->current_patron = PatronModel::find($id);
    }

    public function render()
    {
        $this->getTotals();

        $community_query = Community::query();

        $patron_members = $community_query->whereHas('patron')->where(function($query) {
            $query->whereHas('patron', function($sub_query) {
                $sub_query->whereNotNull('id')->where('town_id', $this->search_town);
            });

            $query->where('first_name', 'like', '%'.$this->search_name.'%');
            $query->orWhere('last_name', 'like', '%'.$this->search_name.'%');
        })
            ->latest()
            ->paginate();


        title('Admin - Patrons');

        return view(
            'livewire.admin.community.patron',
            compact( 'patron_members', ))

            ->extends('layouts.admin')
            ->section('content');
    }
}