<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug', 191);
            $table->string('location');
            $table->integer('order')->unsigned();
            $table->integer('parent_menu_id')->unsigned()->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['slug', 'parent_menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menus');
    }
}
