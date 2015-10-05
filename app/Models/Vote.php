<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Vote
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $voteable_id
 * @property string $voteable_type
 * @property float $rating
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static Builder|Vote whereId($value)
 * @method static Builder|Vote whereUserId($value)
 * @method static Builder|Vote whereVoteableId($value)
 * @method static Builder|Vote whereVoteableType($value)
 * @method static Builder|Vote whereRating($value)
 * @method static Builder|Vote whereCreatedAt($value)
 * @method static Builder|Vote whereUpdatedAt($value)
 * @method static Builder|Vote whereDeletedAt($value)
 */
class Vote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'votes';

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
        'id'            => 'int',
        'user_id'       => 'int',
        'voteable_id'   => 'int',
        'voteable_type' => 'string',
        'rating'        => 'double'
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
