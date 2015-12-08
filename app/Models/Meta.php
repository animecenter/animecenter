<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Route;

/**
 * AC\Models\Meta.
 *
 * @property int $id
 * @property string $route
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @method static \Illuminate\Database\Query\Builder|Meta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Meta whereRoute($value)
 * @method static \Illuminate\Database\Query\Builder|Meta whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|Meta whereKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|Meta whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|Meta whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|Meta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Meta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Meta whereDeletedAt($value)
 */
class Meta extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'metas';

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
        'id'          => 'int',
        'route'       => 'string',
        'title'       => 'string',
        'keywords'    => 'string',
        'description' => 'string',
        'active'      => 'boolean',
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
     * The list of routes name to remove from meta routes.
     *
     * @param array $routes
     */
    public function setRoutesToRemove(array $routes = [])
    {
        if (isset($routes)) {
            $this->routesToRemove = array_merge(['dashboard', '_debugbar', 'fontawesome'], $routes);
        }

        return;
    }

    /**
     * The list of meta routes.
     *
     * @return \Illuminate\Support\Collection
     */
    public function routes()
    {
        $this->setRoutesToRemove();

        return collect(Route::getRoutes()->getRoutes())->filter(function ($item) {
            return (check_if_string_contains_a_value_from_array($item->uri(), $this->routesToRemove) === false) &&
            $item->methods()[0] === 'GET';
        });
    }
}
