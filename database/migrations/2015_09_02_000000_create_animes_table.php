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
            $table->string('image')->nullable();
            $table->text('synopsis')->nullable();
            $table->integer('type_id')->unsigned()->nullable();
            $table->integer('number_of_episodes')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->date('release_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('duration')->nullable();
            $table->integer('season_id')->unsigned()->nullable();
            $table->integer('classification_id')->unsigned()->nullable();
            $table->float('rating')->default(0);
            $table->integer('views')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('animes');
    }
}
