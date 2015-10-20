<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypesTable extends Migration
{

    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('model', 191);
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['name', 'model']);
        });
    }

    public function down()
    {
        Schema::drop('types');
    }
}
