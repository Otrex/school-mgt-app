<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmailForCommunityMember;
use App\Traits\Utilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;

class Community extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $guard = 'community';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'phone',
        'password',
        'state',
        'state_id',
        'local_government',
        'local_government_id',
        'town',
        'is_patron',
        'town_id',
        'is_tertiary_institution',
        'tertiary_institution_id',
        'home_address',
        'image',
        'referrer_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['fullname', 'initial'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_tertiary_institution' => 'boolean'
    ];

    public function results()
    {
        return $this->hasMany(Result::class, 'community_id');
    }

    /**
     * Get the student's fullname.
     *
     */
    public function getFullNameAttribute() : string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the student's fullname initials.
     *
     */
    public function getInitialAttribute() : string
    {
        return strtoupper("{$this->first_name[0]}{$this->last_name[0]}");
    }

    public function vouchers()
    {
        return $this->morphMany(Voucher::class, 'voucherable');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailForCommunityMember);
    }

    public function finishes()
    {
        return $this->morphMany(Finish::class, 'finishable');
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function answers()
    {
        return $this->morphMany(Answer::class, 'answerable');
    }

    public function attempts()
    {
        return $this->morphMany(Attempt::class, 'attemptable');
    }

    public function examResults()
    {
        return $this->morphMany(ExamResult::class, 'exam_resultable');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function localGovernment()
    {
        return $this->belongsTo(LocalGovernment::class);
    }

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function tertiaryInstitution()
    {
        return $this->belongsTo(TertiaryInstitution::class);
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'owner_id');
    }

    public function referred()
    {
        return $this->hasManyThrough(Community::class, Referral::class, 'owner_id', 'referred_id');
    }

    public function resourceLogs()
    {
        return $this->hasMany(CommunityResourceLog::class, 'owner_id');
    }

    public function patron()
    {
        return $this->hasOne(Patron::class, 'member_id');
    }
}