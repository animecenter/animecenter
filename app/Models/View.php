<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\View
 *
 * @property integer $id
 * @property string $date
 * @property integer $viewable_id
 * @property string $viewable_type
 * @property integer $count
 * @method static Builder|View whereId($value)
 * @method static Builder|View whereDate($value)
 * @method static Builder|View whereViewableId($value)
 * @method static Builder|View whereViewableType($value)
 * @method static Builder|View whereCount($value)
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
        'count'         => 'int'
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'id' => 'required|integer|min:1'
    ];
}
