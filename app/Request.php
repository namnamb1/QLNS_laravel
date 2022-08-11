<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'request';
    protected $fillable = ['member_id','full_name', 'gender', 'tinh', 'huyen', 'address', 'status', 'brith_date', 'avatar'];
}
