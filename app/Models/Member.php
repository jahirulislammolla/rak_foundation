<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Member extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','email','phone','profession','address',
        'membership_type','fee','is_paid','payment_method','transaction_id',
        'photo_path','status','approved_at','approved_by',
        'membership_no','start_date','end_date','note',
    ];

    protected $casts = [
        'is_paid'     => 'boolean',
        'approved_at' => 'datetime',
        'start_date'  => 'date',
        'end_date'    => 'date',
    ];

    // Scopes
    public function scopeApproved($q) { return $q->where('status', 'approved'); }
    public function scopePending($q)  { return $q->where('status', 'pending'); }

    // Accessors
    public function getPhotoUrlAttribute(): ?string {
        return $this->photo_path ? asset('storage/'.$this->photo_path) : null;
    }

    public function getTypeLabelAttribute(): string {
        return $this->membership_type === 'lifetime' ? 'Lifetime' : 'Yearly';
    }

    // Membership No generator (ensures uniqueness)
    public static function makeMembershipNo(): string {
        $year = now()->format('Y');
        $seq = str_pad((string) (static::whereYear('created_at', $year)->count() + 1), 4, '0', STR_PAD_LEFT);
        $membershipNo = "RAK-{$year}-{$seq}";
        // Ensure uniqueness in case of race condition
        while (static::where('membership_no', $membershipNo)->exists()) {
            $seq = str_pad((string) ((int)$seq + 1), 4, '0', STR_PAD_LEFT);
            $membershipNo = "RAK-{$year}-{$seq}";
        }
        return $membershipNo;
    }
}
