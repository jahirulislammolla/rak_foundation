<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationCause extends Model {
    protected $fillable = ['name','is_active','priority'];
    public function donations() { return $this->hasMany(Donation::class); }
}