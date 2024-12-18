<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoOrdenAndDiaConsultaToSigsaBase extends Migration
{
    public function up()
    {
        Schema::table('formulario_sigsa_base', function (Blueprint $table) {
            $table->date('dia_consulta')->nullable()->after('id'); // Añadir Día de la Consulta
            $table->string('no_historia_clinica')->nullable()->after('dia_consulta'); // Añadir No. Historia Clínica
        });
    }

    public function down()
    {
        Schema::table('formulario_sigsa_base', function (Blueprint $table) {
            $table->dropColumn('dia_consulta');
            $table->dropColumn('no_historia_clinica');
        });
    }
}
