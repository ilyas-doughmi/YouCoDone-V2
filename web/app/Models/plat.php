<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\menu;

class plat extends Model
{
    protected $table = 'plat';
    protected $fillable = [
        'name',
        'description',
        'prix',
        'menuId',
    ];

    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }

    public function menu()
    {
        return $this->belongsTo(menu::class, 'menuId');
    }
}
