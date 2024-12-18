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
        Schema::create('residencia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulario_base_id'); // Relación con formulario base
            $table->string('comunidad_direccion')->nullable();
            $table->string('municipio_residencia')->nullable();
            $table->String('agricola_migrante')->nullable();
            $table->String('embarazada')->nullable();
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
        Schema::dropIfExists('residencia');
    }
};
