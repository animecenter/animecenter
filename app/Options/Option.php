<?php

namespace App\Options;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Options\Option
 *
 * @property integer $id 
 * @property string $value 
 * @method static \Illuminate\Database\Query\Builder|\App\Options\Option whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Options\Option whereValue($value)
 */
class Option extends Model
{
    protected $table = 'options';

    public $timestamps = false;

//    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['value'];

    protected $visible = ['value'];
}
