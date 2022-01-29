<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacaos', function (Blueprint $table) {
            $table->increments('id');
      
            $table->string('legenda')->nullable();
            $table->string('tipo');
            $table->string('conteudo')->nullable();
            $table->string('estado');
            $table->unsignedInteger('agente_id');
            $table->unsignedInteger('permissao_id');
            $table->foreign('permissao_id')->references('id')->on('permissaos');
            $table->foreign('agente_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('publicacaos');
    }
}
