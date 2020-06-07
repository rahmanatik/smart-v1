<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    public function category()
    {
        return $this->hasOne('App\Models\Category');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }
}
