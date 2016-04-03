<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * AC\Models\AnimeGenre.
 *
 * @property int $anime_id
 * @property int $genre_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @method static \Illuminate\Database\Query\Builder|AnimeGenre whereAnimeId($value)
 * @method static \Illuminate\Database\Query\Builder|AnimeGenre whereGenreId($value)
 * @method static \Illuminate\Database\Query\Builder|AnimeGenre whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AnimeGenre whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AnimeGenre whereDeletedAt($value)
 */
class AnimeGenre extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anime_genre';

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
        'anime_id' => 'int',
        'genre_id' => 'int',
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
