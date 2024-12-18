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
        Schema::create('mujer15a49y_otros_grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulario_base_id'); // Relación con formulario base

            // Grupo de la persona
            $table->enum('grupo', ['mujer_15_49', 'otros_grupos']);

            // Fecha de vacunación
            $table->date('fecha_vacunacion');

            // Tipo de dosis
            $table->enum('tipo_dosis', ['1a', '2a', '3a', 'r1', 'r2']);

            $table->timestamps();

            // Clave foránea hacia formulario_sigsa_base
            $table->foreign('formulario_base_id')->references('id')->on('formulario_sigsa_base')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosis_vacunacion');
    }
};
