<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('menu_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->integer('role_access')->default(0);
            $table->integer('create')->default(0);
            $table->integer('read')->default(0);
            $table->integer('update')->default(0);
            $table->integer('delete')->default(0);
            $table->integer('import')->default(0);
            $table->integer('export')->default(0);
            $table->integer('print')->default(0);
            $table->integer('sync')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_menus');
    }
}
