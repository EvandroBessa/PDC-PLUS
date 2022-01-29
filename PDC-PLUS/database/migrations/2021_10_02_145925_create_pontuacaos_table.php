<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePontuacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pontuacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valor');
            $table->unsignedInteger('agente_id');
            $table->unsignedInteger('publicacao_id');
            $table->foreign('agente_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('publicacao_id')->references('id')->on('publicacaos')->onDelete('CASCADE');
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
        Schema::dropIfExists('pontuacaos');
    }
}
