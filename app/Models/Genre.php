<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Genre
 *
 * @property integer $id
 * @property string $name
 * @property string $model
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Anime[] $animes
 * @method static Builder|Genre whereId($value)
 * @method static Builder|Genre whereName($value)
 * @method static Builder|Genre whereModel($value)
 * @method static Builder|Genre whereDescription($value)
 * @method static Builder|Genre whereCreatedAt($value)
 * @method static Builder|Genre whereUpdatedAt($value)
 * @method static Builder|Genre whereDeletedAt($value)
 * @property boolean $active
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Genre whereActive($value)
 */
class Genre extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'genres';

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
        'name'        => 'string',
        'description' => 'string'
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
     * Get all animes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function animes()
    {
        return $this->belongsToMany(Anime::class, 'anime_genre', 'anime_id', 'genre_id');
    }
}
