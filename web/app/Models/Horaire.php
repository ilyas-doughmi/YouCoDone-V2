<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\restaurant;
class Horaire extends Model
{
    protected $table = 'horaire';

    protected $fillable = [
        'jour',
        'heure_ouverture',
        'heure_fermeture',
        'status',
        'restaurantId',
    ];

    public function restaurant()
    {
        return $this->belongsTo(restaurant::class,'restaurantId');
    }
}
