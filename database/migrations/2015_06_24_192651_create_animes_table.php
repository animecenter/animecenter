<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnimesTable extends Migration
{
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->text('content')->nullable();
            $table->string('genres', 255)->nullable();
            $table->string('episodes', 255)->nullable();
            $table->string('type', 255)->default('any');
            $table->string('age', 255)->default('any');
            $table->string('type2', 255)->default('subbed');
            $table->string('status', 255)->default('ongoing');
            $table->string('prequel', 255)->nullable();
            $table->string('sequel', 255)->nullable();
            $table->string('story', 255)->nullable();
            $table->string('side_story', 255)->nullable();
            $table->string('spin_off', 255)->nullable();
            $table->string('alternative', 255)->nullable();
            $table->string('other', 255)->nullable();
            $table->string('position', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('alternative_title', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->float('rating');
            $table->integer('votes')->unsigned();
            $table->integer('visits')->unsigned()->default('0');
            $table->integer('date')->unsigned()->default('1389787200');
            $table->integer('date2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('animes');
    }
}
