<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriosVacuna extends Model
{
    use HasFactory;

    // Definir la tabla asociada a este modelo
    protected $table = 'criterios_vacuna';

    // Definir los campos rellenables (fillable)
    protected $fillable = [
        'formulario_sigsa_base_id',
        'vacuna',
        'grupo_priorizado',
        'fecha_administracion',
        'dosis',
    ];

    // Relación inversa con el formulario en la tabla formulario_sigsa_base
    public function formularioSIGSA5bA()
    {
        return $this->belongsTo(Modelo5bA::class, 'formulario_sigsa_base_id');
    }

    // Relación con el modelo Vacuna (para obtener el nombre de la vacuna)
    public function vacuna()
    {
        return $this->belongsTo(Vacuna::class);
    }
}
