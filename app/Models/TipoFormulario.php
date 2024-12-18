<?php

namespace App\Models;

use App\Http\Controllers\FormularioController5bA;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoFormulario extends Model
{
    use HasFactory;

    protected $table = 'tipo_formularios';

    protected $fillable = [
        'codigo_formulario',
    ];

    // Relación many-to-many con los formularios (por ejemplo, Modelo5bA o FormularioSIGSA5b)
    public function formulariosSIGSA()
    {
        // Relación con los formularios usando la tabla pivote 'formulario_sigsa_tipo_formulario'
        return $this->belongsToMany(FormularioSIGSA5b::class, 'formulario_sigsa_tipo_formulario', 'tipo_formulario_id', 'formulario_sigsa_base_id');
    }



}
