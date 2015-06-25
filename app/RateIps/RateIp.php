<?php

namespace App\RateIps;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\RateIps\RateIp
 *
 * @property integer $id 
 * @property integer $target 
 * @property string $ip 
 * @property string $type 
 * @method static \Illuminate\Database\Query\Builder|\App\RateIps\RateIp whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RateIps\RateIp whereTarget($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RateIps\RateIp whereIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RateIps\RateIp whereType($value)
 */
class RateIp extends Model
{
    protected $table = 'rate_ips';

    public $timestamps = false;

//    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['target', 'ip', 'type'];

    protected $visible = ['target', 'ip', 'type'];
}
