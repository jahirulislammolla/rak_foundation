<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','slug','priority','is_active'];

    protected $casts = ['priority'=>'integer','is_active'=>'boolean'];

    public function works() {
        return $this->hasMany(Work::class);
    }
}
