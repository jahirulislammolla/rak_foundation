<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = [
        'event_id','full_name','email','phone','ticket_type','amount',
        'payment_method','transaction_id','consent','status',
    ];

    protected $casts = [
        'consent' => 'boolean',
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
