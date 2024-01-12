<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bar_tapa_id'); // Esta es la combinación de bar y tapa
            $table->integer('rating'); // Puntuación dada por el usuario
            $table->text('comment')->nullable(); // Columna para comentarios

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bar_tapa_id')->references('id')->on('bar_tapa')->onDelete('cascade');
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
        Schema::dropIfExists('votos');
    }
};