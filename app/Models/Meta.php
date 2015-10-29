<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Meta.
 *
 * @property int $id
 * @property string $route
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property boolean $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @method static Builder|Meta whereId($value)
 * @method static Builder|Meta whereRoute($value)
 * @method static Builder|Meta whereTitle($value)
 * @method static Builder|Meta whereKeywords($value)
 * @method static Builder|Meta whereDescription($value)
 * @method static Builder|Meta whereActive($value)
 * @method static Builder|Meta whereCreatedAt($value)
 * @method static Builder|Meta whereUpdatedAt($value)
 * @method static Builder|Meta whereDeletedAt($value)
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
}
