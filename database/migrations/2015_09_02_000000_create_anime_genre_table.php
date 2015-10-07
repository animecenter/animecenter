<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnimeGenreTable extends Migration
{
    public function up()
    {
        Schema::create('anime_genre', function (Blueprint $table) {
            $table->integer('anime_id')->unsigned();
            $table->integer('genre_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['anime_id', 'genre_id']);
        });
    }

    public function down()
    {
        Schema::drop('anime_genre');
    }
}
