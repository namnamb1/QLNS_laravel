<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'id_rq';
    protected $fillable = ['member_id', 'rq_full_name', 'rq_gender', 'rq_tinh', 'rq_huyen', 'rq_address', 'rq_status', 'rq_brith_date', 'rq_avatar'];
    public $timestamps = false;
    
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
