<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'image',
        'cover_photo',
        'moyasar_account_id',
        'is_active',
        'plan',
        'account_type',
        'payment_status',
        'otp',
        'otp_expires_at',
        'is_active_user'
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
        ];
    }

    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function scopePlan($query, $plan)
    {
        return $query->where('plan', $plan);
    }

    public function hasPlan(string $plan): bool
    {
        return $this->plan === $plan;
    }

    public function sentChats()
    {
        return $this->hasMany(Chat::class, 'user_id');
    }

    public function receivedChats()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }

    public function chats()
    {
        return $this->sentChats()->union($this->receivedChats());
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function messages()
    {
        return $this->sentMessages()->union($this->receivedMessages());
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    public function isFollowing(User $user): bool
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    protected static function booted()
    {
        Event::listen(Login::class, function ($event) {
            $event->user->update(['is_active' => true]);
        });

        Event::listen(Logout::class, function ($event) {
            $event->user->update(['is_active' => false]);
        });
    }
}
