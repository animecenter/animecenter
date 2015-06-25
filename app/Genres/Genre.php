<?php

namespace App\Genres;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    protected $table = 'genres';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name');
    protected $visible = array('name');

    public function animes()
    {
        return $this->belongsToMany('App\Animes\Anime', 'anime_genre', 'anime_id', 'genre_id');
    }
}
