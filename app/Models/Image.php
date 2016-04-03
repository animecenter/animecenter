<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * AC\Models\Image.
 *
 * @property int $id
 * @property int $user_id
 * @property int $imageable_id
 * @property string $imageable_type
 * @property string $path
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @method static \Illuminate\Database\Query\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Image whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Image whereImageableId($value)
 * @method static \Illuminate\Database\Query\Builder|Image whereImageableType($value)
 * @method static \Illuminate\Database\Query\Builder|Image wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|Image whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Image whereDeletedAt($value)
 */
class Image extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

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
        'user_id'        => 'int',
        'imageable_id'   => 'int',
        'imageable_type' => 'string',
        'path'           => 'string',
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
}
