<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $fillable = ['full_name', 'email', 'password', 'gender', 'tinh', 'huyen', 'address', 'status', 'brith_date', 'avatar', 'role', 'department_id'];
    protected $hidden = [
        'password',
    ];
}
