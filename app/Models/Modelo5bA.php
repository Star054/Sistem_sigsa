<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo5bA extends Model
{
    use HasFactory;

    // Definir la tabla asociada a este modelo
    protected $table = 'formulario_sigsa_base'; // Tabla base

    // Definir los campos rellenables (fillable)
    protected $fillable = [
        'vacuna',
        'codigo_formulario',     // Código del formulario
        'nombre_paciente',       // Nombre del paciente
        'cui',                   // CUI del paciente
        'area_salud',            // Área de salud
        'distrito_salud',        // Distrito de salud
        'municipio',             // Municipio
        'servicio_salud',        // Servicio de salud
        'responsable_informacion',// Responsable de la información
        'cargo_responsable',     // Cargo del responsable
        'anio',                  // Año
        'sexo',                  // Sexo del paciente
        'pueblo',                // Pueblo
        'fecha_nacimiento',      // Fecha de nacimiento
        'comunidad_linguistica', // Comunidad lingüística
        'orientacion_sexual',    // Orientación sexual
        'escolaridad',           // Escolaridad
        'profesion_oficio',      // Profesión u oficio
        'no_orden',
        'orientacion_sexual'
    ];

    // Relación con la tabla `criterios_vacuna`
    public function criteriosVacuna()
    {
        return $this->hasMany(CriteriosVacuna::class, 'formulario_sigsa_base_id');
    }



    // Relación con la tabla `residencia`
    public function residencia()
    {
        return $this->hasOne(Residencia::class, 'formulario_base_id');
    }

    // Relación many-to-many con `TipoFormulario`
    public function tipoFormularios()
    {
        return $this->belongsToMany(TipoFormulario::class, 'formulario_sigsa_tipo_formulario', 'formulario_sigsa_base_id', 'tipo_formulario_id');
    }




}
