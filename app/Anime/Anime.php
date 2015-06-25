<?php

namespace App\Anime;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anime extends Model
{
    protected $table = 'animes';

    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('title', 'content', 'genres', 'episodes', 'type', 'age', 'type2', 'status', 'prequel', 'sequel', 'story', 'side_story', 'spin_off', 'alternative', 'other', 'position', 'description', 'alternative_title', 'image', 'rating', 'votes', 'visits', 'date', 'date2');
    protected $visible = array('title', 'content', 'genres', 'episodes', 'type', 'age', 'type2', 'status', 'prequel', 'sequel', 'story', 'side_story', 'spin_off', 'alternative', 'other', 'position', 'description', 'alternative_title', 'image', 'rating', 'votes', 'visits', 'date', 'date2');

    public function episodes()
    {
        return $this->hasMany('App\Episodes\Episode', 'anime_id');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genres\Genre', 'anime_genre', 'anime_id', 'genre_id');
    }
}
