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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8);
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50);
            $table->string('nombres', 100);
            $table->tinyInteger('edad');
            $table->string('genero', 20);
            $table->string('estado_matricula', 20);
            $table->string('email', 50)->nullable();

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
        Schema::dropIfExists('alumnos');
    }
};
