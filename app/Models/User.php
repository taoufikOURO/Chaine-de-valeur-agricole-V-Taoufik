<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function semis()
    {
        return $this->hasMany(Semis::class);
    }

    public function arrosage()
    {
        return $this->hasMany(Arrosage::class);
    }
    public function parcelle()
    {
        return $this->hasMany(Parcelle::class);
    }
    public function fertilisation()
    {
        return $this->hasMany(Fertilisation::class);
    }
    public function recolte()
    {
        return $this->hasMany(Recolte::class);
    }

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'phone_number',
        'first_name',
        'last_name',
        'active',
        'role_id',
        'password',
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
}
