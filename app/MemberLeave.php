<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberLeave extends Model
{
    protected $table = 'member_leave';
    protected $fillable = ['member_id','date_leave'];
    public $timestamps = false;
}
