<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * AC\Models\Page.
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|View[] $views
 *
 * @method static \Illuminate\Database\Query\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|Page whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|Page whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|Page whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Page whereDeletedAt($value)
 */
class Page extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

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
        'id'      => 'int',
        'title'   => 'string',
        'slug'    => 'string',
        'content' => 'string',
        'active'  => 'boolean',
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
     * Get all of the pages views.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }
}
