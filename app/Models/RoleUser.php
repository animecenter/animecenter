<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\RoleUser
 *
 * @property integer $user_id
 * @property integer $role_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static Builder|RoleUser whereUserId($value)
 * @method static Builder|RoleUser whereRoleId($value)
 * @method static Builder|RoleUser whereCreatedAt($value)
 * @method static Builder|RoleUser whereUpdatedAt($value)
 * @method static Builder|RoleUser whereDeletedAt($value)
 */
class RoleUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_user';

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
        'user_id' => 'int',
        'role_id' => 'int'
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
