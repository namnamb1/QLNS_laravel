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
        return $this->belongsTo(Department::class,'department_id');
    }

    public function document()
    {
        return $this->hasOne(Document::class);
    }

}
