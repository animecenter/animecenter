<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEpisodesTable extends Migration
{
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->text('subdub')->nullable();
            $table->boolean('show')->default(0);
            $table->text('not_yeird')->nullable();
            $table->text('raw')->nullable();
            $table->text('hd')->nullable();
            $table->text('mirror1')->nullable();
            $table->text('mirror2')->nullable();
            $table->text('mirror3')->nullable();
            $table->text('mirror4')->nullable();
            $table->integer('anime_id')->unsigned();
            $table->integer('date')->nullable();
            $table->integer('date2')->nullable();
            $table->float('rating');
            $table->integer('votes')->unsigned();
            $table->integer('visits')->unsigned()->default('0');
            $table->integer('order')->unsigned()->nullable();
            $table->datetime('coming_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('episodes');
    }
}
