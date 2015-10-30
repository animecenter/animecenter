<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Vote.
 *
 * @property int $id
 * @property int $user_id
 * @property int $voteable_id
 * @property string $voteable_type
 * @property float $rating
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \ $votes
 * @property-read User $user
 *
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
        'rating'        => 'double',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'id' => 'required|integer|min:1',
    ];

    /**
     * Get all of the owning votes models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function votes()
    {
        return $this->morphTo();
    }

    /**
     * Get user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
