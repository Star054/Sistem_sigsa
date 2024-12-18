<?php

namespace App\Http\Controllers;

use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class PDFTestController extends Controller
{
    public function generarPDF()
    {
        // Contenido HTML básico
        $html = '<h1>PDF de Prueba</h1><p>Este es un PDF de prueba generado con Snappy.</p>';

        // Cargar el contenido HTML en Snappy y generar el PDF
        $pdf = PDF::loadHTML($html);

        // Descargar el PDF generado
        return $pdf->download('prueba.pdf');


    }
}
