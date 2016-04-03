<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * AC\Models\Type.
 *
 * @property int $id
 * @property string $name
 * @property string $model
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Anime[] $animes
 *
 * @method static \Illuminate\Database\Query\Builder|Type whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Type whereName($value)
 * @method static \Illuminate\Database\Query\Builder|Type whereModel($value)
 * @method static \Illuminate\Database\Query\Builder|Type whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Type whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Type whereDeletedAt($value)
 */
class Type extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'types';

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
        'id'     => 'int',
        'name'   => 'string',
        'model'  => 'string',
        'active' => 'boolean',
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
     * Get animes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function animes()
    {
        return $this->hasMany(Anime::class, 'type_id', 'id');
    }
}
