<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relation whereRelationshipId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relation whereRelationableId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relation whereRelationableType($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relation whereRelatedId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relation whereDeletedAt($value)
 */
class Relation extends Model
{
    //
}
