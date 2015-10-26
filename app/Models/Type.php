<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Type
 *
 * @property integer $id
 * @property string $name
 * @property string $model
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static Builder|Type whereId($value)
 * @method static Builder|Type whereName($value)
 * @method static Builder|Type whereModel($value)
 * @method static Builder|Type whereCreatedAt($value)
 * @method static Builder|Type whereUpdatedAt($value)
 * @method static Builder|Type whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|Anime[] $animes
 * @property boolean $active
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Type whereActive($value)
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
        'id'    => 'int',
        'name'  => 'string',
        'model' => 'string'
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'id' => 'required|integer|min:1'
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
