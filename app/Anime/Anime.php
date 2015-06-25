<?php

namespace App\Anime;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Anime\Anime
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Episodes\Episode[] $episodes 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Genres\Genre[] $genres 
 */
class Anime extends Model
{
    protected $table = 'animes';

    public $timestamps = false;

//    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'content', 'genres', 'episodes', 'type', 'age', 'type2', 'status', 'prequel', 'sequel', 'story',
        'side_story', 'spin_off', 'alternative', 'other', 'position', 'description', 'alternative_title', 'image',
        'rating', 'votes', 'visits', 'date', 'date2'
    ];

    protected $visible = [
        'title', 'content', 'genres', 'episodes', 'type', 'age', 'type2', 'status', 'prequel', 'sequel', 'story',
        'side_story', 'spin_off', 'alternative', 'other', 'position', 'description', 'alternative_title', 'image',
        'rating', 'votes', 'visits', 'date', 'date2'
    ];

    public function episodes()
    {
        return $this->hasMany('App\Episodes\Episode', 'anime_id');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genres\Genre', 'anime_genre', 'anime_id', 'genre_id');
    }
}
