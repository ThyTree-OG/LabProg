<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_type_id', // Foreign key reference to user_types table
        'first_name',
        'last_name',
        'user_name',
        'email',
        'password',
        'user_photo_url', // Optional user photo URL
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->user_type_id === 1;
    }

    public function favorites()
    {
        return $this->belongsToMany(Book::class, 'book_user_favourite');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function currentSubscription()
    {
        return $this->hasOne(Subscription::class)->latest();
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function plan()
    {
        return $this->belongsToMany(Plan::class, 'subscriptions')
            ->withPivot('start_date')
            ->withTimestamps();
    }
}
