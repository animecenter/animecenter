<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRateIpsTable extends Migration
{
    public function up()
    {
        Schema::create('rate_ips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('target')->unsigned()->nullable();
            $table->string('ip', 255)->nullable();
            $table->string('type', 255)->default('e');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('rate_ips');
    }
}
