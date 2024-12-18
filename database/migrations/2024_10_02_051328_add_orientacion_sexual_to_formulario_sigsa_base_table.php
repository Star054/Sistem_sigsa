<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('formulario_sigsa_base', function (Blueprint $table) {
            $table->string('orientacion_sexual')->nullable();
        });
    }

    public function down()
    {
        Schema::table('formulario_sigsa_base', function (Blueprint $table) {
            $table->dropColumn('orientacion_sexual');
        });
    }

};
