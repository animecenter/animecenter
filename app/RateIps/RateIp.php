<?php

namespace App\RateIps;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RateIp extends Model
{
    protected $table = 'rate_ips';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('target', 'ip', 'type');
    protected $visible = array('target', 'ip', 'type');
}
