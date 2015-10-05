<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Title
 *
 * @property integer $id
 * @property string $title
 * @property string $language
 * @property integer $titlable_id
 * @property string $titlable_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static Builder|Title whereId($value)
 * @method static Builder|Title whereTitle($value)
 * @method static Builder|Title whereLanguage($value)
 * @method static Builder|Title whereTitlableId($value)
 * @method static Builder|Title whereTitlableType($value)
 * @method static Builder|Title whereCreatedAt($value)
 * @method static Builder|Title whereUpdatedAt($value)
 * @method static Builder|Title whereDeletedAt($value)
 */
class Title extends Model
{
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
        'id'            => 'int',
        'title'         => 'string',
        'language'      => 'string',
        'titlable_id'   => 'int',
        'titlable_type' => 'string'
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
