<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Relationship
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static Builder|Relationship whereId($value)
 * @method static Builder|Relationship whereName($value)
 * @method static Builder|Relationship whereCreatedAt($value)
 * @method static Builder|Relationship whereUpdatedAt($value)
 * @method static Builder|Relationship whereDeletedAt($value)
 */
class Relationship extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'relationships';

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
        'name' => 'string',
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
