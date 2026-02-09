<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\restaurant;

class Reservation extends Model
{

    protected $table = 'reservation';
    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function Restaurant()
    {
        return $this->belongsTo(restaurant::class,'restaurant_id');
    }
}
