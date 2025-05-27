<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        "patron_id",
        "beneficiary_id",
        "amount_left",
        "is_active" // It is only active when the
    ];

    public function patron()
    {
        return $this->belongsTo(Patron::class, 'patron_id');
    }

    public function beneficiary()
    {
        return $this->belongsTo(Community::class, 'beneficiary_id');
    }
}