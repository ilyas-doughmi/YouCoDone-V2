<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\restaurant;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'date',
        'heure',
        'nombre_personnes',
        'status',
    ];
    protected $table = 'reservation';
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(restaurant::class,'restaurant_id');
    }
}
