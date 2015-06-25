<?php

namespace App\AnimeGenres;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AnimeGenres\AnimeGenre
 *
 */
class AnimeGenre extends Model
{
    protected $table = 'anime_genre';

    public $timestamps = false;

//    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
