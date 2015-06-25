<?php

namespace App\AnimeGenres;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnimeGenre extends Model
{
    protected $table = 'anime_genre';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
