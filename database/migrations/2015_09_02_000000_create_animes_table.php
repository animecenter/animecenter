<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnimesTable extends Migration
{
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mal_id')->unsigned();
            $table->string('title', 191);
            $table->string('slug', 191)->unique();
            $table->integer('image_id')->nullable();
            $table->integer('episode_image_id')->nullable();
            $table->text('synopsis')->nullable();
            $table->integer('type_id')->unsigned()->nullable();
            $table->smallInteger('year')->unsigned()->nullable();
            $table->integer('number_of_episodes')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->date('release_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('duration')->nullable();
            $table->integer('calendar_season_id')->unsigned()->nullable();
            $table->integer('classification_id')->unsigned()->nullable();
            $table->float('rating')->default(0);
            $table->integer('views')->default(0);
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('animes');
    }
}
