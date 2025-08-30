<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FocusArea extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title','slug','icon_class','image',
        'short_description','description','order','is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    // scope for public pages
    public function scopeActive(){
        return $this->where('is_active', true);
    }
}
