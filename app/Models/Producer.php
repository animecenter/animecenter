<?php

namespace AC\Producers;

use Illuminate\Database\Eloquent\Model;

/**
 * AC\Producers\Producer
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\AC\Producers\Producer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Producers\Producer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Producers\Producer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Producers\Producer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Producers\Producer whereDeletedAt($value)
 */
class Producer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'producers';

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
