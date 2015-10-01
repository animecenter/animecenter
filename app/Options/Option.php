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
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\AC\Options\Option whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Options\Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Options\Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Options\Option whereDeletedAt($value)
 */
class Option extends Model
{
    protected $table = 'options';

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = ['value'];

    protected $visible = ['value'];
}
