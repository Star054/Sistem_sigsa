<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormularioSigsaTipoFormularioTable extends Migration
{
    public function up()
    {
        Schema::create('formulario_sigsa_tipo_formulario', function (Blueprint $table) {
            $table->id();

            // Definir clave foránea con un nombre más corto
            $table->unsignedBigInteger('formulario_sigsa_base_id');
            $table->foreign('formulario_sigsa_base_id', 'fk_sigsa_base')
                ->references('id')
                ->on('formulario_sigsa_base')
                ->onDelete('cascade');

            $table->unsignedBigInteger('tipo_formulario_id');
            $table->foreign('tipo_formulario_id', 'fk_tipo_formulario')
                ->references('id')
                ->on('tipo_formularios')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('formulario_sigsa_tipo_formulario');
    }
}
