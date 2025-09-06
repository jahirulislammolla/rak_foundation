<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
        'priority'     => 'integer',
        'is_active'    => 'boolean',
    ];

    public function category() {
        return $this->belongsTo(WorkCategory::class, 'work_category_id');
    }

    // for public listing
    public function scopePublishedActive($q) {
        return $q->where('is_active', true)
                 ->whereNotNull('published_at')
                 ->where('published_at','<=', now());
    }
    
}
