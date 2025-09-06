<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Committee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','designation','short_description','photo','priority', 'contact'
    ];

    protected $casts = [
        'priority' => 'integer',
    ];
}
