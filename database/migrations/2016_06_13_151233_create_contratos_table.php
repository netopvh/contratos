<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use CodeBase\Enum\Status;
use CodeBase\Enum\TipoContrato;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('casa_id')->unsigned();
            $table->foreign('casa_id')->references('id')->on('casas');
            $table->integer('unidade_id')->unsigned()->nullable();
            $table->foreign('unidade_id')->references('id')->on('unidades')->onDelete('cascade');
            $table->string('aditivado',1)->nullable();
            $table->string('numero');
            $table->enum('tipo', TipoContrato::getKeys());
            $table->integer('ano', false, true)->length(4);
            $table->decimal('total',10,2);
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->timestamp('data_inicio');
            $table->string('arquivo');
            $table->timestamp('data_fim');
            $table->timestamp('origem');
            $table->decimal('valor_origem',10,2);
            $table->timestamp('encerramento');
            $table->longText('comentario_origem');
            $table->enum('status',Status::getKeys());
            $table->longText('comentario');
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
        Schema::drop('contratos');
    }
}
