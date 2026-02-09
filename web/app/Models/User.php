<?php

namespace App\Models;

 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\restaurant;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function restaurant()
    {
        return $this->hasMany(restaurant::class,'userId');
    }

    public function favoris()
    {
        return $this->belongsToMany(restaurant::class, 'favori', 'userId', 'restaurantId')->withTimestamps();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class,'user_id');
    }
}
