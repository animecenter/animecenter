<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Vote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Vote whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Vote whereVoteableId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Vote whereVoteableType($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Vote whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Vote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Vote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Vote whereDeletedAt($value)
 */
class Vote extends Model
{
    //
}
