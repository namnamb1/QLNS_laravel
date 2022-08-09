<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    protected $fillable = ['member_id','start_date','end_date','can_cuoc','papers','cv_member','contract'];
    public $timestamps = false;
}
