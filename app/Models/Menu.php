<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * AC\Models\Menu.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $location
 * @property int $order
 * @property int $parent_menu_id
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @method static \Illuminate\Database\Query\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Query\Builder|Menu whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|Menu whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|Menu whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|Menu whereParentMenuId($value)
 * @method static \Illuminate\Database\Query\Builder|Menu whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Menu whereDeletedAt($value)
 */
class Menu extends Model
{
    //
}
