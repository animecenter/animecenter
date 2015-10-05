<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Genre
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|Anime[] $animes
 * @method static Builder|Genre whereId($value)
 * @method static Builder|Genre whereName($value)
 * @method static Builder|Genre whereType($value)
 * @method static Builder|Genre whereDescription($value)
 * @property string $model
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Genre whereModel($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Genre whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Genre whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Genre whereDeletedAt($value)
 */
class Genre extends Model
{
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
    protected $guarded = [''];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var string[]
     */
    protected $dates = [''];

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
