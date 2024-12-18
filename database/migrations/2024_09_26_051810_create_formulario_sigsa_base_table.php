<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormularioSigsaBaseTable extends Migration
{
    public function up()
    {
        Schema::create('formulario_sigsa_base', function (Blueprint $table) {
            $table->id();  // Llave primaria

            // Campos del componente <x-formulario-slot>
            $table->string('vacuna')->nullable();
            $table->string('area_salud')->nullable();
            $table->string('distrito_salud')->nullable();
            $table->string('municipio')->nullable();
            $table->string('servicio_salud')->nullable();
            $table->string('responsable_informacion')->nullable();
            $table->string('cargo_responsable')->nullable();
            $table->year('anio')->nullable();  // Año
            $table->string('mes')->nullable();

            // Campos de datos del paciente
            $table->string('no_orden')->nullable();
            $table->string('cui')->nullable();
            $table->string('nombre_paciente');
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->integer('pueblo')->nullable();

            $table->date('fecha_nacimiento')->nullable();
            $table->integer('comunidad_linguistica')->nullable();  // Comunidad lingüística (1-23 según lista)
            $table->integer('escolaridad')->nullable();  // Escolaridad (0-7 según lista)
            $table->integer('profesion_oficio')->nullable();  // Profesión u oficio (0-8 según lista)
            $table->integer('discapacidad')->nullable();


            $table->timestamps();  // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('formulario_sigsa_base');
    }
}
