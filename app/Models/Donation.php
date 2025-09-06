<?php

// app/Models/Donation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model {
    protected $fillable = [
        'donation_cause_id','amount','payment_method','full_name','email','phone',
        'address','is_anonymous','note','status','approved_at','rejected_at',
        'reviewed_by','transaction_id','meta'
    ];

    protected $casts = [
        'is_anonymous'=>'boolean',
        'approved_at'=>'datetime',
        'rejected_at'=>'datetime',
        'meta'=>'array',
    ];

    public function cause() { return $this->belongsTo(DonationCause::class, 'donation_cause_id'); }
    public function reviewer() { return $this->belongsTo(User::class, 'reviewed_by'); }

    public function scopeFilter($q, $filters) {
        return $q->when($filters['status'] ?? null, fn($qq,$s)=>$qq->where('status',$s))
                 ->when($filters['cause_id'] ?? null, fn($qq,$cid)=>$qq->where('donation_cause_id',$cid))
                 ->when($filters['search'] ?? null, function($qq,$s){
                     $qq->where(function($w) use ($s){
                         $w->where('full_name','like',"%$s%")
                           ->orWhere('email','like',"%$s%")
                           ->orWhere('phone','like',"%$s%")
                           ->orWhere('transaction_id','like',"%$s%");
                     });
                 });
    }
}

