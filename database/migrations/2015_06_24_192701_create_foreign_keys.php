<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('episodes', function (Blueprint $table) {
            $table->foreign('anime_id')->references('id')->on('animes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('anime_genre', function (Blueprint $table) {
            $table->foreign('anime_id')->references('id')->on('animes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('anime_genre', function (Blueprint $table) {
            $table->foreign('genre_id')->references('id')->on('genres')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('episodes', function (Blueprint $table) {
            $table->dropForeign('episodes_anime_id_foreign');
        });
        Schema::table('anime_genre', function (Blueprint $table) {
            $table->dropForeign('anime_genre_anime_id_foreign');
        });
        Schema::table('anime_genre', function (Blueprint $table) {
            $table->dropForeign('anime_genre_genre_id_foreign');
        });
    }
}
