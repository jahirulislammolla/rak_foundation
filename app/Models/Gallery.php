<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','image_path','is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function getImageUrlAttribute(): ?string {
        return $this->image_path ? asset('storage/'.$this->image_path) : null;
    }
}
