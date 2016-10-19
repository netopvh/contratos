<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_casas', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('casa_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('casa_id')->references('id')->on('casas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['user_id', 'casa_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_casas');
    }
}
