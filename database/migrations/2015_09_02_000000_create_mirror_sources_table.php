<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMirrorSourcesTable extends Migration
{
    public function up()
    {
        Schema::create('mirror_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191)->unique();
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('mirror_sources');
    }
}
