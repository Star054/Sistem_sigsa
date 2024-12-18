<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consulta';

    protected $fillable = [
        'consulta',
        'control',
        'semana_gestacion',
        'viene',
        'fue',
        'referido_a',
        'diagnostico',
        'codigo_cie',
        'tratamiento_descripcion',
        'tratamiento_presentacion',
        'cantidad_recetada',
        'notificacion_lugar',
        'notificacion_numero',
        'nombre_acompanante',
        'formulario_sigsa_base_id',  // Clave foránea
    ];

    // Relación con el formulario SIGSA (Modelo3CS)
    public function formulario()
    {
        return $this->belongsTo(Modelo3CS::class, 'formulario_sigsa_base_id');
    }
}
