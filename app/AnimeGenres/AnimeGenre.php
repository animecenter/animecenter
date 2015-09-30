<?php

namespace AC\AnimeGenres;

use Illuminate\Database\Eloquent\Model;

/**
 * AC\AnimeGenres\AnimeGenre
 *
 */
class AnimeGenre extends Model
{
    protected $table = 'anime_genre';

    public $timestamps = false;

    protected $dates = ['deleted_at'];
}
