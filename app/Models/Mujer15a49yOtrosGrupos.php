<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mujer15a49yOtrosGrupos extends Model
{
    use HasFactory;

    protected $table = 'mujer15a49y_otros_grupos';

    // Lista de campos que se pueden asignar de manera masiva
    protected $fillable = [
        'formulario_base_id',
        'grupo',               // Grupo: 'mujer_15_49' o 'otros_grupos'
        'fecha_vacunacion',
        'tipo_dosis',          // Tipo de dosis: '1a', '2a', '3a', 'r1', 'r2'
    ];

    // Relación con el modelo FormularioSIGSA5b
    public function formularioSIGSA5b()
    {
        return $this->belongsTo(FormularioSIGSA5b::class, 'formulario_base_id');
    }


}
