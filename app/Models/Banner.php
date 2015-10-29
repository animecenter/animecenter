<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Banner.
 *
 * @property int $id
 * @property string $title
 * @property string $link_to
 * @property string $big_title
 * @property string $content
 * @property int $order
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @method static Builder|Banner whereId($value)
 * @method static Builder|Banner whereTitle($value)
 * @method static Builder|Banner whereLinkTo($value)
 * @method static Builder|Banner whereBigTitle($value)
 * @method static Builder|Banner whereContent($value)
 * @method static Builder|Banner whereOrder($value)
 * @method static Builder|Banner whereActive($value)
 * @method static Builder|Banner whereCreatedAt($value)
 * @method static Builder|Banner whereUpdatedAt($value)
 * @method static Builder|Banner whereDeletedAt($value)
 */
class Banner extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banners';

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
        'link_to'     => 'string',
        'big_title'   => 'string',
        'small_title' => 'string',
        'content'     => 'string',
        'order'       => 'int',
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
