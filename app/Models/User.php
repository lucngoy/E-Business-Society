<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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

    // Relation : Un utilisateur peut laisser plusieurs reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Vérifie si l'utilisateur est un propriétaire de business
    public function isBusinessOwner()
    {
        return $this->role === 'business_owner';
    }

    // Vérifie si l'utilisateur est un utilisateur régulier
    public function isUser()
    {
        return $this->role === 'user';
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
