<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static $TYPES = [
        1 => "Assistant Professor",
        2 => "Lecturer",
        3 => "Teaching Assistant",
        4 => "Course Instructor / Sessional Lecturer",
        5 => "Guest Lectures",
    ];


    public function scopeActive()
    {
        return $this->where('status', 1);
    }
}
