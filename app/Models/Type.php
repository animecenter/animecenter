<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * AC\Models\Type
 *
 * @property integer $id
 * @property string $name
 * @property string $model
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Type whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Type whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Type whereModel($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Type whereUpdatedAt($value)
 */
class Type extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'model'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
