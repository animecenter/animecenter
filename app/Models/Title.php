<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Title.
 *
 * @property int $id
 * @property string $title
 * @property string $language
 * @property int $titleable_id
 * @property string $titleable_type
 * @property boolean $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \ $titles
 *
 * @method static Builder|Title whereId($value)
 * @method static Builder|Title whereTitle($value)
 * @method static Builder|Title whereLanguage($value)
 * @method static Builder|Title whereTitleableId($value)
 * @method static Builder|Title whereTitleableType($value)
 * @method static Builder|Title whereActive($value)
 * @method static Builder|Title whereCreatedAt($value)
 * @method static Builder|Title whereUpdatedAt($value)
 * @method static Builder|Title whereDeletedAt($value)
 */
class Title extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'titles';

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
        'id'             => 'int',
        'title'          => 'string',
        'language'       => 'string',
        'titleable_id'   => 'int',
        'titleable_type' => 'string',
        'active'         => 'boolean',
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
     * Get all of the owning viewable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function titles()
    {
        return $this->morphTo();
    }
}
