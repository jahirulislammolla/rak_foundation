<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function scopeActive()
    {
        return $this->where('status', 1);
    }
}
