<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use Carbon\Carbon;
use App\Models\Modelo3CS;
use Detection\MobileDetect;
class PDFController3CS extends Controller
{
    // Método para obtener la altura máxima de una fila
    private function getMaxRowHeight($pdf, $rowData, $columnWidths)
    {
        $maxHeight = 0;
        foreach ($rowData as $key => $data) {
            // Calcular el número de líneas que ocupará cada celda
            $lines = $pdf->getNumLines($data, $columnWidths[$key]);
            // Calcular la altura de la celda en función de la cantidad de líneas y el tamaño de la fuente
            $height = $lines * 3; // Se asume una altura de línea de 3 (ajustar según sea necesario)
            if ($height > $maxHeight) {
                $maxHeight = $height;
            }
        }
        return $maxHeight;
    }

    public function generarPDF3CS(Request $request)
    {
        // Capturar los valores del formulario para filtrar pacientes
        $vacuna = $request->input('vacuna');
        $mes = Carbon::createFromFormat('Y-m', $request->input('mes'))->month;
        $anio = Carbon::createFromFormat('Y-m', $request->input('mes'))->year;

        // Obtener los pacientes que coincidan con los filtros
        $pacientes = Modelo3CS::with(['residencia', 'consulta'])
            ->whereHas('consulta', function ($query) use ($vacuna, $mes, $anio) {
                $query->whereMonth('dia_consulta', $mes)
                    ->whereYear('dia_consulta', $anio)
                    ->where('tratamiento_descripcion', $vacuna);
            })
            ->get();

        if ($pacientes->isEmpty()) {
            return redirect()->back()->withErrors(['mensaje' => 'No se encontraron pacientes para generar el PDF.']);
        }

        // Obtener el primer paciente para los datos del encabezado
        $primerPaciente = $pacientes->first();
        $area_salud = $primerPaciente->area_salud;
        $distrito_salud = $primerPaciente->distrito_salud;
        $municipio = $primerPaciente->municipio;
        $servicio_salud = $primerPaciente->servicio_salud;
        $responsable_informacion = $primerPaciente->responsable_informacion;
        $cargo_responsable = $primerPaciente->cargo_responsable;

        // Crear PDF con TCPDF en formato horizontal (Landscape) y tamaño oficio (Legal)
        $pdf = new TCPDF('L', PDF_UNIT, 'FOLIO', true, 'UTF-8', false);
        $pdf->SetMargins(5, 5, 5);

        // Establecer información del documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema de Consultas');
        $pdf->SetTitle('Reporte de Consultas - SIGSA3CS');

        // Añadir página
        $pdf->AddPage();

        // Logos
        $pdf->Image(public_path('logos/logo.jpg'), 10, 10, 20);
        $pdf->Image(public_path('logos/logo2.jpg'), 40, 10, 20);

        // Título
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 15, 'Reporte de Consultas - Formulario SIGSA3CS', 0, 1, 'C');

        // Vacuna a la derecha
        $pdf->SetFont('helvetica', '', 7);
        $pdf->SetXY(140, 25);
        $pdf->Cell(0, 10, 'Vacuna: ' . $vacuna, 0, 0, 'L');

        // Información del formulario (Código, Versión, Vigencia)
        $pdf->SetFont('helvetica', '', 7);
        $pdf->SetY(10);
        $pdf->SetX(-60);
        $pdf->MultiCell(50, 5, "Código: FOR-SIGSA-3CS\nVersión: 1.0\nVigente a partir de: Octubre 2024", 0, 'R');

        $pdf->Ln(10);

        $pdf->SetFont('helvetica', '', 7);
        $cellWidth = 91;

        // Primera fila de información adicional
        $pdf->Cell($cellWidth, 6, 'Área de Salud: ' . $area_salud, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Distrito de Salud: ' . $distrito_salud, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Municipio: ' . $municipio, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Servicio de Salud: ' . $servicio_salud, 0, 1, 'L');

        // Segunda fila de información adicional
        $pdf->Cell($cellWidth, 6, 'Responsable de la Información: ' . $responsable_informacion, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Cargo: ' . $cargo_responsable, 0, 0, 'L');

        // Ajustar el tamaño de las celdas para los campos más cortos
        $smallCellWidth = 55;

        $pdf->Cell($smallCellWidth, 6, 'Año: ' . $anio, 0, 0, 'L');
        $pdf->Cell($smallCellWidth, 6, 'Mes: ' . str_pad($mes, 2, '0', STR_PAD_LEFT), 0, 0, 'L');
        $pdf->Cell($smallCellWidth, 6, 'Firma: .......................', 0, 1, 'L');
        $pdf->Ln(5);

        // Definir los anchos de las columnas ajustados
        $columnWidths = [
            'no_historia_clinica' => 8,
            'dia_consulta' => 13,
            'nombre_paciente' => 30,
            'cui' => 11,
            'sexo' => 4,
            'pueblo' => 3.5,
            'comunidad_linguistica' => 14,
            'fecha_nacimiento' => 13.5,
            'orientacion_sexual' => 14,
            'escolaridad' => 11,
            'profesion_oficio' => 10,
            'comunidad_direccion' => 15,
            'municipio_residencia' => 15,
            'agricola_migrante' => 11,
            'consulta' => 3.6,
            'control' => 3.6,
            'semana_gestacion' => 12,
            'viene' => 3.5,
            'fue' => 4,
            'referido_a' => 12,
            'diagnostico' => 17,
            'tratamiento_descripcion' => 20,
            'tratamiento_presentacion' => 15.5,
            'cantidad_recetada' => 11.4,
            'notificacion_lugar' => 10,
            'notificacion_numero' => 10,
            'nombre_acompanante' => 23,
        ];

        $cellHeight = 20;

        // Agregar los encabezados de las columnas
        $pdf->SetFont('helvetica', 'B', 6);

        // Encabezados, ajusta las columnas de acuerdo a tus necesidades
        foreach ($columnWidths as $key => $width) {
            $pdf->MultiCell($width, $cellHeight, ucfirst(str_replace('_', ' ', $key)), 1, 'C', 0, 0);
        }
        $pdf->Ln();

        // Añadir los datos de los pacientes usando MultiCell
        $pdf->SetFont('helvetica', '', 6);
        foreach ($pacientes as $paciente) {
            foreach ($paciente->consulta as $consulta) {
                $rowData = [
                    'no_historia_clinica' => $paciente->no_historia_clinica ?? 'N/A',
                    'dia_consulta' => isset($paciente->dia_consulta) ? Carbon::parse($paciente->dia_consulta)->format('d-m-Y') : 'N/A',
                    'nombre_paciente' => $paciente->nombre_paciente,
                    'cui' => $paciente->cui ?? 'N/A',
                    'sexo' => $paciente->sexo ?? 'N/A',
                    'pueblo' => $paciente->pueblo ?? 'N/A',
                    'comunidad_linguistica' => $paciente->comunidad_linguistica ?? 'N/A',
                    'fecha_nacimiento' => $paciente->fecha_nacimiento ? Carbon::parse($paciente->fecha_nacimiento)->format('d-m-Y') : '',

                    'orientacion_sexual' => $paciente->orientacion_sexual ?? 'N/A',
                    'escolaridad' => $paciente->escolaridad ?? 'N/A',
                    'profesion_oficio' => $paciente->profesion_oficio ?? 'N/A',
                    'comunidad_direccion' => $paciente->residencia->comunidad_direccion ?? 'N/A',
                    'municipio_residencia' => $paciente->residencia->municipio_residencia ?? 'N/A',
                    'agricola_migrante' => $paciente->residencia->agricola_migrante ?? 'N/A',
                    'consulta' => $consulta->consulta ?? 'N/A',
                    'control' => $consulta->control ?? 'N/A',
                    'semana_gestacion' => $consulta->semana_gestacion ?? 'N/A',
                    'viene' => $consulta->viene ?? 'N/A',
                    'fue' => $consulta->fue ?? 'N/A',
                    'referido_a' => $consulta->referido_a ?? 'N/A',
                    'diagnostico' => $consulta->diagnostico ?? 'N/A',
                    'tratamiento_descripcion' => $consulta->tratamiento_descripcion ?? 'N/A',
                    'tratamiento_presentacion' => $consulta->tratamiento_presentacion ?? 'N/A',
                    'cantidad_recetada' => $consulta->cantidad_recetada ?? 'N/A',
                    'notificacion_lugar' => $consulta->notificacion_lugar ?? 'N/A',
                    'notificacion_numero' => $consulta->notificacion_numero ?? 'N/A',
                    'nombre_acompanante' => $consulta->nombre_acompanante ?? 'N/A',
                ];

                $maxHeight = max($this->getMaxRowHeight($pdf, $rowData, $columnWidths), 5);

                foreach ($rowData as $key => $data) {
                    $pdf->MultiCell($columnWidths[$key], $maxHeight, $data, 1, 'L', 0, 0);
                }

                $pdf->Ln();
            }
        }

        $detect = new MobileDetect();
        if ($detect->isMobile() || $detect->isTablet()) {
            $pdf->Output('reporte_pacientes_3CS.pdf', 'D'); // 'D' descarga el archivo
        } else {
            $pdf->Output('reporte_pacientes_3CS.pdf', 'I'); // 'I' muestra en el navegador
        }
    }
}
