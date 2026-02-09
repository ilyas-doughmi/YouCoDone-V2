<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'restaurantId',
        'name',
    ];

    public function restaurant()
    {
        return $this->belongsTo(restaurant::class, 'restaurantId');
    }

    public function plat()
    {
        return $this->hasMany(plat::class, 'menuId');
    }
}
