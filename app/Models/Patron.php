<?php

namespace App\Models;

use App\Enums\TransactionSource;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patron extends Model
{
    use HasFactory;

    protected $fillable = [
        "member_id",
        "no_of_slots",
        "town_id",
        "amount_contributed",
        'payment_frequency',
        'payment_authorization_code',
        'next_due_date'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'member_id', 'member_id')->where('source', TransactionSource::CONTRIBUTION);
    }

    public function maintenanceTransaction()
    {
        return $this->hasMany(Transaction::class, 'member_id', 'member_id')
            ->where('source', TransactionSource::MAINTENANCE->value);
    }



    public function verifiedTransactions()
    {
        return $this->hasMany(Transaction::class, 'member_id', 'member_id')
            ->where('source', TransactionSource::CONTRIBUTION->value)
            ->where('status', TransactionStatus::COMPLETED->value)->where('type', TransactionType::CREDIT);
    }


    public function member()
    {
        return $this->belongsTo(Community::class, 'member_id');
    }

    public function town()
    {
        return $this->belongsTo(Town::class, 'town_id');
    }

    public function scholarshipSlots()
    {
        return $this->hasMany(ScholarshipSlot::class, 'patron_id');
    }
}