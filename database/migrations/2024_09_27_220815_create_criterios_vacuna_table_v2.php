<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriosVacunaTableV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterios_vacuna', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulario_sigsa_base_id'); // Relación con la tabla base del formulario
            $table->string('vacuna');
            $table->string('grupo_priorizado');
            $table->date('fecha_administracion');
            $table->String('dosis');
            $table->timestamps();

            // Relación con la tabla `formulario_sigsa_base`
            $table->foreign('formulario_sigsa_base_id')->references('id')->on('formulario_sigsa_base')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criterios_vacuna');
    }
}
