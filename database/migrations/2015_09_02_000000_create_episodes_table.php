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
            $table->float('number')->unsigned();
            $table->string('title')->nullable();
            $table->text('synopsis')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamp('aired_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['anime_id', 'number']);
        });
    }

    public function down()
    {
        Schema::drop('episodes');
    }
}
