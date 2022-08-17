<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiUser extends Model
{
    protected $table = 'api_user';
    protected $fillable = ['email', 'phone', 'full_name'];
    public $timestamps = false;
}
