<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacuna extends Model
{
    use HasFactory;

    // Campos que son asignables en masa
    protected $fillable = [
        'nombre_vacuna',
        'descripcion',
    ];
}
