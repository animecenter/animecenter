<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassificationsTable extends Migration
{

    public function up()
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191)->unique();
        });
    }

    public function down()
    {
        Schema::drop('classifications');
    }
}
