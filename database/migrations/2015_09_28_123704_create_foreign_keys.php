<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('animes', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('classification_id')->references('id')->on('classifications')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('anime_genre', function (Blueprint $table) {
            $table->foreign('anime_id')->references('id')->on('animes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('anime_producer', function (Blueprint $table) {
            $table->foreign('anime_id')->references('id')->on('animes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('producer_id')->references('id')->on('producers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('episodes', function (Blueprint $table) {
            $table->foreign('anime_id')->references('id')->on('animes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        Schema::table('mirrors', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('episode_id')->references('id')->on('episodes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('mirror_source_id')->references('id')->on('mirror_sources')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('role_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        Schema::table('permission_role', function (Blueprint $table) {
            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        Schema::table('votes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropForeign('password_resets_email_foreign');
        });
        Schema::table('animes', function (Blueprint $table) {
            $table->dropForeign('animes_type_id_foreign');
            $table->dropForeign('animes_season_id_foreign');
            $table->dropForeign('animes_classification_id_foreign');
        });
        Schema::table('anime_genre', function (Blueprint $table) {
            $table->dropForeign('anime_genre_anime_id_foreign');
            $table->dropForeign('anime_genre_genre_id_foreign');
        });
        Schema::table('anime_producer', function (Blueprint $table) {
            $table->dropForeign('anime_producer_anime_id_foreign');
            $table->dropForeign('anime_producer_producer_id_foreign');
        });
        Schema::table('episodes', function (Blueprint $table) {
            $table->dropForeign('episodes_anime_id_foreign');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_user_id_foreign');
        });
        Schema::table('mirrors', function (Blueprint $table) {
            $table->dropForeign('mirrors_user_id_foreign');
            $table->dropForeign('mirrors_episode_id_foreign');
            $table->dropForeign('mirrors_mirror_source_id_foreign');
        });
        Schema::table('role_user', function (Blueprint $table) {
            $table->dropForeign('role_user_user_id_foreign');
            $table->dropForeign('role_user_role_id_foreign');
        });
        Schema::table('permission_role', function (Blueprint $table) {
            $table->dropForeign('permission_role_permission_id_foreign');
            $table->dropForeign('permission_role_role_id_foreign');
        });
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign('votes_user_id_foreign');
        });
    }
}
