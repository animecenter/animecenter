<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Relation
 *
 * @property integer $id
 * @property integer $relationship_id
 * @property integer $relationable_id
 * @property string $relationable_type
 * @property integer $related_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static Builder|Relation whereId($value)
 * @method static Builder|Relation whereRelationshipId($value)
 * @method static Builder|Relation whereRelationableId($value)
 * @method static Builder|Relation whereRelationableType($value)
 * @method static Builder|Relation whereRelatedId($value)
 * @method static Builder|Relation whereCreatedAt($value)
 * @method static Builder|Relation whereUpdatedAt($value)
 * @method static Builder|Relation whereDeletedAt($value)
 */
class Relation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'relations';

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
        'id'                => 'int',
        'relationship_id'   => 'int',
        'relationable_id'   => 'int',
        'relationable_type' => 'string',
        'related_id'        => 'int'
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'id' => 'required|integer|min:1'
    ];

    /**
     * Get relations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function relationable()
    {
        return $this->morphTo();
    }

    /**
     * Get relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relationship()
    {
        return $this->belongsTo(Relationship::class, 'id', 'relationship_id');
    }
}
