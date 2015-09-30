<?php

namespace AC\Options;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Options\Option
 *
 * @property integer $id
 * @property string $value
 * @method static Builder|Option whereId($value)
 * @method static Builder|Option whereValue($value)
 */
class Option extends Model
{
    protected $table = 'options';

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = ['value'];

    protected $visible = ['value'];
}
