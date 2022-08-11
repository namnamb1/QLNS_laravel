<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    protected $table = 'districts';

    public function city()
    {
        return $this->hasMany(Cities::class, 'city_id');
    }
}
