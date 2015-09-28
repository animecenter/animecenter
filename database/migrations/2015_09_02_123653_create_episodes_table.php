<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEpisodesTable extends Migration
{

    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anime_id')->unsigned();
            $table->integer('number')->unsigned();
            $table->string('name')->nullable();
            $table->string('slug', 191)->unique()->nullable();
            $table->text('synopsis')->nullable();
            $table->boolean('status')->default(false);
            $table->datetime('air_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('episodes');
    }
}
