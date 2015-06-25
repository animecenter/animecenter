<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bigtitle', 255)->nullable();
            $table->string('smalltitle', 255)->nullable();
            $table->text('content')->nullable();
            $table->string('file', 255);
            $table->string('link', 255);
            $table->datetime('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('images');
    }
}
