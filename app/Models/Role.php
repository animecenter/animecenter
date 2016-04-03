<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * AC\Models\Role.
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|Role whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|Role whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Role whereDeletedAt($value)
 */
class Role extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

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
        'id'           => 'int',
        'name'         => 'string',
        'display_name' => 'string',
        'description'  => 'string',
        'active'       => 'boolean',
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
