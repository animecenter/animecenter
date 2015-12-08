<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * AC\Models\Relation.
 *
 * @property int $id
 * @property int $relationship_id
 * @property int $relationable_id
 * @property string $relationable_type
 * @property int $related_id
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \ $relationable
 * @property-read Relationship $relationship
 *
 * @method static \Illuminate\Database\Query\Builder|Relation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Relation whereRelationshipId($value)
 * @method static \Illuminate\Database\Query\Builder|Relation whereRelationableId($value)
 * @method static \Illuminate\Database\Query\Builder|Relation whereRelationableType($value)
 * @method static \Illuminate\Database\Query\Builder|Relation whereRelatedId($value)
 * @method static \Illuminate\Database\Query\Builder|Relation whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|Relation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Relation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Relation whereDeletedAt($value)
 */
class Relation extends Model
{
    use SoftDeletes;

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
        'related_id'        => 'int',
        'active'            => 'boolean',
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
