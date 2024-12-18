<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residencia extends Model
{
    use HasFactory;

    protected $table = 'residencia';

    // Lista de campos que se pueden asignar de manera masiva
    protected $fillable = [
        'formulario_base_id',  // Relación con el formulario
        'comunidad_direccion',
        'municipio_residencia',
        'agricola_migrante',
        'embarazada',
    ];

    //Relacion con el modelo consulta
    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }
    // Relación con el modelo FormularioSIGSA5b
    public function formularioSIGSA5b()
    {
        return $this->belongsTo(FormularioSIGSA5b::class, 'formulario_base_id');
    }



}
