<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\User;
use App\Models\menu;
use App\Models\Horaire;

class restaurant extends Model
{
    protected $table = 'restaurant';
    protected $fillable = [
        'nom',
        'description',
        'userId',
        'categorie',
        'localisation',
        'capacite',
        'image',
        'isActive',
        'isDeleted',
    ];
    protected $casts = [
        'isActive' => 'boolean',
        'isDeleted' => 'boolean',
        'capacite' => 'integer',
    ];
    
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    
    public function menus()
    {
        return $this->hasMany(menu::class, 'restaurantId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favori', 'restaurantId', 'userId')->withTimestamps();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class,'restaurant_id');
    }

    public function horaires()
    {
        return $this->hasMany(Horaire::class,'restaurantId');
    }
}
