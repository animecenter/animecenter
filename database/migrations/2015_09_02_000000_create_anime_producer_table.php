<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnimeProducerTable extends Migration
{
    public function up()
    {
        Schema::create('anime_producer', function (Blueprint $table) {
            $table->integer('anime_id')->unsigned();
            $table->integer('producer_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['anime_id', 'producer_id']);
        });
    }

    public function down()
    {
        Schema::drop('anime_producer');
    }
}
