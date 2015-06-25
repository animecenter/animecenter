<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatasTable extends Migration
{
    public function up()
    {
        Schema::create('datas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('s_add')->nullable();
            $table->text('s_edit')->nullable();
            $table->text('e_add')->nullable();
            $table->text('e_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('datas');
    }
}
