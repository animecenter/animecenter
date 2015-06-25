<?php

namespace App\Datas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Datas\Data
 *
 * @property integer $id 
 * @property string $s_add 
 * @property string $s_edit 
 * @property string $e_add 
 * @property string $e_edit 
 * @method static \Illuminate\Database\Query\Builder|\App\Datas\Data whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Datas\Data whereSAdd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Datas\Data whereSEdit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Datas\Data whereEAdd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Datas\Data whereEEdit($value)
 */
class Data extends Model
{
    protected $table = 'datas';

    public $timestamps = false;

//    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['s_add', 's_edit', 'e_add', 'e_edit'];

    protected $visible = ['s_add', 's_edit', 'e_add', 'e_edit'];
}
