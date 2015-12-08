<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * AC\Models\Option.
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @method static \Illuminate\Database\Query\Builder|Option whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Option whereName($value)
 * @method static \Illuminate\Database\Query\Builder|Option whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|Option whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Option whereDeletedAt($value)
 */
class Option extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'options';

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
        'id'     => 'int',
        'name'   => 'string',
        'value'  => 'string',
        'active' => 'boolean',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'id' => 'required|integer|min:1',
    ];
}
