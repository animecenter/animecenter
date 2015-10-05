<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * AC\Models\Relationship
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relationship whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relationship whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relationship whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relationship whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Relationship whereDeletedAt($value)
 */
class Relationship extends Model
{
    //
}
