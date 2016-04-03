<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * AC\Models\View.
 *
 * @property int $id
 * @property string $date
 * @property int $viewable_id
 * @property string $viewable_type
 * @property int $count
 * @property-read \ $viewable
 * @method static \Illuminate\Database\Query\Builder|View whereId($value)
 * @method static \Illuminate\Database\Query\Builder|View whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|View whereViewableId($value)
 * @method static \Illuminate\Database\Query\Builder|View whereViewableType($value)
 * @method static \Illuminate\Database\Query\Builder|View whereCount($value)
 */
class View extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'views';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

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
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var string[]
     */
    protected $dates = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id'            => 'int',
        'date'          => 'date',
        'viewable_id'   => 'int',
        'viewable_type' => 'string',
        'count'         => 'int',
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
    public function viewable()
    {
        return $this->morphTo();
    }
}
