<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

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
 * @method static Builder|Menu whereId($value)
 * @method static Builder|Menu whereName($value)
 * @method static Builder|Menu whereSlug($value)
 * @method static Builder|Menu whereLocation($value)
 * @method static Builder|Menu whereOrder($value)
 * @method static Builder|Menu whereParentMenuId($value)
 * @method static Builder|Menu whereActive($value)
 * @method static Builder|Menu whereCreatedAt($value)
 * @method static Builder|Menu whereUpdatedAt($value)
 * @method static Builder|Menu whereDeletedAt($value)
 */
class Menu extends Model
{
    //
}
