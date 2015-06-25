<?php

namespace App\Genres;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Genres\Genre
 *
 * @property integer $id 
 * @property string $value 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Animes\Anime[] $animes 
 * @method static \Illuminate\Database\Query\Builder|\App\Genres\Genre whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Genres\Genre whereValue($value)
 */
class Genre extends Model
{
    protected $table = 'genres';

    public $timestamps = false;

//    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name'];

    protected $visible = ['name'];

    public function animes()
    {
        return $this->belongsToMany('App\Animes\Anime', 'anime_genre', 'anime_id', 'genre_id');
    }
}
