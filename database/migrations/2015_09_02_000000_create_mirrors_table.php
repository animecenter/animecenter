<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMirrorsTable extends Migration
{
    public function up()
    {
        Schema::create('mirrors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('episode_id')->unsigned();
            $table->integer('mirror_source_id')->unsigned();
            $table->integer('language_id')->unsigned()->default(1);
            $table->string('url', 191)->unique();
            $table->string('translation');
            $table->string('quality');
            $table->boolean('mobile_friendly')->default(false);
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('mirrors');
    }
}
