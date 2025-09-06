<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title','slug','location','register_url','short_description','description',
        'start_at','end_at','banner_path','is_active','is_featured','priority',
        'created_by','updated_by'
    ];

    protected $casts = [
        'start_at'   => 'datetime',
        'end_at'     => 'datetime',
        'is_active'  => 'boolean',
        'is_featured'=> 'boolean',
        'priority'   => 'integer',
    ];

    // Auto slug on create if missing
    protected static function booted(): void {
        static::creating(function (Event $event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug(Str::limit($event->title, 60, ''));
            }
        });
    }

    // Scopes
    public function scopePublished(Builder $q): Builder {
        return $q->where('is_active', true);
    }

    public function scopeUpcoming(Builder $q): Builder {
        return $q->where('start_at', '>=', now());
    }

    // Accessors
    public function getBannerUrlAttribute(): ?string {
        return $this->banner_path ? asset('storage/'.$this->banner_path) : null;
    }

    public function getDaysRemainingAttribute(): ?int {
        if (!$this->start_at) return null;
        $days = Carbon::now()->startOfDay()->diffInDays($this->start_at->startOfDay(), false);
        return $days >= 0 ? $days : null;
    }

    public function getFormattedDateAttribute(): string {
        return $this->start_at?->format('d M Y') ?? '';
    }
}
