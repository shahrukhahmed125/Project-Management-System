<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'password_changed_at',
        'is_online',
        'last_seen_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_enabled' => 'boolean',
            'last_seen_at' => 'datetime',
        ];
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function getLastSeenAttribute()
    {
        if ($this->last_seen_at) {
            return Carbon::parse($this->last_seen_at)->diffForHumans();
        }
        return 'Never';
    }

    public function generateTwoFactorCode()
    {
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = Carbon::now()->addMinutes(10);
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function emailUpdated()
    {
        $this->email = $this->pending_email;
        $this->pending_email = null;
        $this->save();
    }

    public static function GenerateEmployeeId()
    {
        // include soft-deleted rows so a used employee ID is never reused
        $latest = self::withTrashed()
            ->where('user_id', 'like', 'USR-%')
            ->orderByDesc('user_id')
            ->first();

        $nextNumber = $latest ? (int) substr($latest->user_id, -3) + 1 : 1;
        return sprintf('USR-%03d', $nextNumber);
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->uuid)) {
                $user->uuid = (string) Str::uuid();
            }
        });
    }

    public function routeNotificationForMail($notification)
    {
        if ($notification instanceof \App\Notifications\VerifyNewEmail) {
            return $this->pending_email;
        }

        return $this->email;
    }
}
