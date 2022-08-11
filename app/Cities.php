<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = 'cities'; 
    
    public function districts()
    {
        return $this->hasMany(Districts::class, 'city_id');
    }
}
