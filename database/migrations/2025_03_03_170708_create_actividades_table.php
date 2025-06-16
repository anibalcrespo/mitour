<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_actividad_id');

            // Definir la clave foránea
            $table->foreign('tipo_actividad_id')
                ->references('id')->on('tipo_actividades')
                ->onDelete('restrict');

            $table->string('titulo');
            $table->text('descripcion');
            $table->text('image1');
            $table->text('image2')->nullable();
            $table->text('image3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_actividades');
    }
};
