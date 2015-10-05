<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * AC\Models\Role
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Role whereDeletedAt($value)
 */
class Role extends Model
{
    //
}
