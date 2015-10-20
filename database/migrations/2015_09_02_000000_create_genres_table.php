<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenresTable extends Migration
{

    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('model', 191);
            $table->text('description')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['name', 'model']);
        });
    }

    public function down()
    {
        Schema::drop('genres');
    }
}
