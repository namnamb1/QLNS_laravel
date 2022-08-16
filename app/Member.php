<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;
    protected $table = 'members';
    protected $fillable = ['full_name', 'email', 'password', 'gender', 'tinh', 'huyen', 'address', 'status', 'brith_date', 'avatar', 'role', 'department_id','phone'];
    protected $hidden = [
        'password',
    ];
    public $timestamps = false;

    public function group()
    {
        return $this->belongsToMany(Group::class, 'group_member', 'member_id', 'group_id');
    }

    public function hasGroup()
    {
        return $this->hasMany(GroupMember::class, 'member_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public function city()
    {
        return $this->hasOne(Cities::class);
    }

    public function districts()
    {
        return $this->belongsTo(Districts::class, 'huyen');
    }

    public function memberLeave()
    {
        return $this->belongsTo(MemberLeave::class);
    }
    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
