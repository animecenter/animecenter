<?php

namespace AC\Producers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Producers\Producer
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static Builder|Producer whereId($value)
 * @method static Builder|Producer whereName($value)
 * @method static Builder|Producer whereCreatedAt($value)
 * @method static Builder|Producer whereUpdatedAt($value)
 * @method static Builder|Producer whereDeletedAt($value)
 */
class Producer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'producers';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var string[]
     */
    protected $hidden = [''];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var string[]
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id'   => 'int',
        'name' => 'string'
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'id' => 'required|integer|min:1'
    ];
}
