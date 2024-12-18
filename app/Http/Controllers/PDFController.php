<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use App\Models\FormularioSIGSA5b;
use App\Models\Modelo5bA;
use Carbon\Carbon;
use Detection\MobileDetect;

class PDFController extends Controller
{

    public function generarPDF5b(Request $request)
    {
        $vacuna = $request->input('vacuna');
        $mes = Carbon::createFromFormat('Y-m', $request->input('mes'))->month;
        $anio = Carbon::createFromFormat('Y-m', $request->input('mes'))->year;

        // Obtener los pacientes que coincidan con los filtros
        $pacientes = FormularioSIGSA5b::with(['residencia', 'mujer15a49yOtrosGrupos'])
            ->whereHas('mujer15a49yOtrosGrupos', function ($query) use ($vacuna, $mes, $anio) {
                $query->whereMonth('fecha_vacunacion', $mes)
                    ->whereYear('fecha_vacunacion', $anio)
                    ->where('vacuna', $vacuna);
            })
            ->get();

        if ($pacientes->isEmpty()) {
            return redirect()->back()->withErrors(['mensaje' => 'No se encontraron pacientes para generar el PDF.']);
        }



        $primerPaciente = $pacientes->first();


        $area_salud = $primerPaciente->area_salud;
        $distrito_salud = $primerPaciente->distrito_salud;
        $municipio = $primerPaciente->municipio;
        $servicio_salud = $primerPaciente->servicio_salud;
        $responsable_informacion = $primerPaciente->responsable_informacion;
        $cargo_responsable = $primerPaciente->cargo_responsable;
        $anio = $primerPaciente->anio;


        $pdf = new TCPDF('L', PDF_UNIT, [215.9, 330.2], true, 'UTF-8', false); // 8.5 x 13 pulgadas en mm
        $pdf->SetMargins(5, 5, 5);


        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema de Vacunación');
        $pdf->SetTitle('Reporte de Pacientes Vacunados - SIGSA5b');

        // Añadir página
        $pdf->AddPage();

        // Logos
        $pdf->Image(public_path('logos/logo.jpg'), 10, 10, 20); // Logo 1
        $pdf->Image(public_path('logos/logo2.jpg'), 40, 10, 20); // Logo 2

        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 15, 'Reporte de Vacunación - Formulario SIGSA5b', 0, 1, 'C');

        // Vacuna a la derecha
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetXY(140, 25);
        $pdf->Cell(0, 10, 'Vacuna: ' . $vacuna, 0, 0, 'L');

        // Información del formulario (Código, Versión, Vigencia)
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetY(10);
        $pdf->SetX(-60);
        $pdf->MultiCell(50, 5, "Código: FOR-SIGSA-5b\nVersión: 3.0\nVigente a partir de: Noviembre 2017", 0, 'R');

        $pdf->Ln(10);

        $pdf->SetFont('helvetica', '', 10);
        $cellWidth = 90;

        // Primera fila de información adicional
        $pdf->Cell($cellWidth, 6, 'Área de Salud: ' . $area_salud, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Distrito de Salud: ' . $distrito_salud, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Municipio: ' . $municipio, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Servicio de Salud: ' . $servicio_salud, 0, 1, 'L');

        // Segunda fila de información adicional
        $pdf->Cell($cellWidth, 6, 'Responsable de la Información: ' . $responsable_informacion, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Cargo: ' . $cargo_responsable, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Año: ' . $anio, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Firma: .......................', 0, 1, 'L');
        $pdf->Ln(5);

        // Definir los anchos de las columnas ajustados
        $columnWidths = [
            'no_orden' => 8,
            'nombre_paciente' => 35, // Aumentamos el ancho para el nombre
            'cui' => 22,
            'sexo' => 10, // Reducido
            'pueblo' => 12, // Reducido
            'comunidad_linguistica' => 21,
            'fecha_nacimiento' => 18,
            'discapacidad' => 16,
            'orientacion_sexual' => 16,
            'escolaridad' => 15,
            'profesion_oficio' => 15,
            'comunidad_direccion' => 25,
            'municipio_residencia' => 25,
            'agricola_migrante' => 15,
            'embarazada' => 15,
            'grupo' => 19,
            'fecha_vacunacion' => 18,
            'tipo_dosis' => 14,
        ];

        // Agregar los encabezados de las columnas
        $pdf->SetFont('helvetica', 'B', 8);

        // Usaremos MultiCell en lugar de Cell para poder ajustar la altura
        $pdf->MultiCell($columnWidths['no_orden'], 7, 'No', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['nombre_paciente'], 7, 'Nombre Paciente', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['cui'], 7, 'CUI', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['sexo'], 7, 'Sexo', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['pueblo'], 7, 'Pueblo', 1, 'C', 0, 0);

        $pdf->MultiCell($columnWidths['comunidad_linguistica'], 7, 'Comunidad Lingüística', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['fecha_nacimiento'], 7, 'Fecha Nac.', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['discapacidad'], 7, 'Discapacidad', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['orientacion_sexual'], 7, 'Orient. Sexual', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['escolaridad'], 7, 'Escolaridad', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['profesion_oficio'], 7, 'Prof./Oficio', 1, 'C', 0, 0);

        $pdf->MultiCell($columnWidths['comunidad_direccion'], 7, 'Comunidad', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['municipio_residencia'], 7, 'Municipio Res.', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['agricola_migrante'], 7, 'Agri. Migrante', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['embarazada'], 7, 'Embarazada', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['grupo'], 7, 'Grupo', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['fecha_vacunacion'], 7, 'Fecha Vac.', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['tipo_dosis'], 7, 'Tipo Dosis', 1, 'C', 0, 1);

        // Añadir los datos de los pacientes
        $pdf->SetFont('helvetica', '', 8);
        foreach ($pacientes as $paciente) {
            // Ahora recorremos todas las dosis del paciente
            foreach ($paciente->mujer15a49yOtrosGrupos as $grupo) {
                // Filtramos solo aquellos grupos que tienen fecha de vacunación dentro del mes y año seleccionado
                if (
                    !empty($grupo->fecha_vacunacion) &&
                    \Carbon\Carbon::parse($grupo->fecha_vacunacion)->month == \Carbon\Carbon::parse(request('mes'))->month &&
                    \Carbon\Carbon::parse($grupo->fecha_vacunacion)->year == \Carbon\Carbon::parse(request('mes'))->year
                ) {
                    // Preparamos los datos para la fila del PDF
                    $rowData = [
                        'no_orden' => $paciente->no_orden,
                        'nombre_paciente' => $paciente->nombre_paciente,
                        'cui' => $paciente->cui,
                        'sexo' => $paciente->sexo,
                        'pueblo' => $paciente->pueblo ?? 'N/A',
                        'comunidad_linguistica' => $paciente->comunidad_linguistica ?? 'N/A',
                        'fecha_nacimiento' => $paciente->fecha_nacimiento ? Carbon::parse($paciente->fecha_nacimiento)->format('d-m-Y') : 'N/A',
                        'discapacidad' => $paciente->discapacidad ?? 'N/A',
                        'orientacion_sexual' => $paciente->orientacion_sexual ?? 'N/A',
                        'escolaridad' => $paciente->escolaridad ?? 'N/A',
                        'profesion_oficio' => $paciente->profesion_oficio ?? 'N/A',
                        'comunidad_direccion' => $paciente->residencia->comunidad_direccion ?? 'N/A',
                        'municipio_residencia' => $paciente->residencia->municipio_residencia ?? 'N/A',
                        'agricola_migrante' => $paciente->residencia->agricola_migrante ?? 'N/A',
                        'embarazada' => $paciente->residencia->embarazada ?? 'N/A',
                        'grupo' => $grupo->grupo,
                        'fecha_vacunacion' => isset($grupo->fecha_vacunacion) ? Carbon::parse($grupo->fecha_vacunacion)->format('d-m-Y') : 'N/A',
                        'tipo_dosis' => $grupo->tipo_dosis ?? 'N/A',
                    ];

                    // Calculamos la altura máxima de la fila
                    $maxHeight = max($this->getMaxRowHeight($pdf, $rowData, $columnWidths), 5);

                    // Escribimos cada celda utilizando MultiCell para ajustar la altura
                    $pdf->MultiCell($columnWidths['no_orden'], $maxHeight, $rowData['no_orden'], 1, 'C', 0, 0);
                    $pdf->MultiCell($columnWidths['nombre_paciente'], $maxHeight, $rowData['nombre_paciente'], 1, 'L', 0, 0);
                    $pdf->MultiCell($columnWidths['cui'], $maxHeight, $rowData['cui'], 1, 'L', 0, 0);
                    $pdf->MultiCell($columnWidths['sexo'], $maxHeight, $rowData['sexo'], 1, 'C', 0, 0);
                    $pdf->MultiCell($columnWidths['pueblo'], $maxHeight, $rowData['pueblo'], 1, 'L', 0, 0);

                    $pdf->MultiCell($columnWidths['comunidad_linguistica'], $maxHeight, $rowData['comunidad_linguistica'], 1, 'L', 0, 0);
                    $pdf->MultiCell($columnWidths['fecha_nacimiento'], $maxHeight, $rowData['fecha_nacimiento'], 1, 'C', 0, 0);

                    $pdf->MultiCell($columnWidths['discapacidad'], $maxHeight, $rowData['discapacidad'], 1, 'C', 0, 0);
                    $pdf->MultiCell($columnWidths['orientacion_sexual'], $maxHeight, $rowData['orientacion_sexual'], 1, 'L', 0, 0);
                    $pdf->MultiCell($columnWidths['escolaridad'], $maxHeight, $rowData['escolaridad'], 1, 'L', 0, 0);
                    $pdf->MultiCell($columnWidths['profesion_oficio'], $maxHeight, $rowData['profesion_oficio'], 1, 'L', 0, 0);

                    $pdf->MultiCell($columnWidths['comunidad_direccion'], $maxHeight, $rowData['comunidad_direccion'], 1, 'L', 0, 0);
                    $pdf->MultiCell($columnWidths['municipio_residencia'], $maxHeight, $rowData['municipio_residencia'], 1, 'L', 0, 0);
                    $pdf->MultiCell($columnWidths['agricola_migrante'], $maxHeight, $rowData['agricola_migrante'], 1, 'C', 0, 0);
                    $pdf->MultiCell($columnWidths['embarazada'], $maxHeight, $rowData['embarazada'], 1, 'C', 0, 0);
                    $pdf->MultiCell($columnWidths['grupo'], $maxHeight, $rowData['grupo'], 1, 'L', 0, 0);
                    $pdf->MultiCell($columnWidths['fecha_vacunacion'], $maxHeight, $rowData['fecha_vacunacion'], 1, 'C', 0, 0);
                    $pdf->MultiCell($columnWidths['tipo_dosis'], $maxHeight, $rowData['tipo_dosis'], 1, 'L', 0, 1);
                }
            }
        }

        $detect = new MobileDetect();

        // Si es móvil o tablet, forzar descarga
        if ($detect->isMobile() || $detect->isTablet()) {
            $pdf->Output('reporte_pacientes_5b.pdf', 'D'); // Descargar el PDF
        } else {
            $pdf->Output('reporte_pacientes_5b.pdf', 'I');
        }
    }

// Función para obtener la altura máxima de una fila
    private function getMaxRowHeight($pdf, $rowData, $columnWidths)
    {
        $heights = [];
        foreach ($rowData as $key => $data) {
            $heights[] = $pdf->getStringHeight($columnWidths[$key], $data);
        }
        return max($heights);
    }


    public function generarPDF5bA(Request $request)
    {
        // Capturar los valores del formulario para filtrar pacientes
        $vacuna = $request->input('vacuna');
        $mes = Carbon::createFromFormat('Y-m', $request->input('mes'))->month;
        $anio = Carbon::createFromFormat('Y-m', $request->input('mes'))->year;

        // Obtener los pacientes que coincidan con los filtros
        $pacientes = Modelo5bA::with(['residencia', 'criteriosVacuna'])
            ->whereHas('criteriosVacuna', function ($query) use ($vacuna, $mes, $anio) {
                $query->whereMonth('fecha_administracion', $mes)
                    ->whereYear('fecha_administracion', $anio)
                    ->where('vacuna', $vacuna);
            })
            ->get();

        if ($pacientes->isEmpty()) {
            return redirect()->back()->withErrors(['mensaje' => 'No se encontraron pacientes para generar el PDF.']);
        }

        // Obtener el primer paciente
        $primerPaciente = $pacientes->first();
        $area_salud = $primerPaciente->area_salud;
        $distrito_salud = $primerPaciente->distrito_salud;
        $municipio = $primerPaciente->municipio;
        $servicio_salud = $primerPaciente->servicio_salud;
        $responsable_informacion = $primerPaciente->responsable_informacion;
        $cargo_responsable = $primerPaciente->cargo_responsable;
        $anio = $primerPaciente->anio;

        // Crear PDF con TCPDF en formato horizontal (Landscape) y tamaño oficio (Legal)
//        $pdf = new TCPDF('L', PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
//        $pdf->SetMargins(5, 5, 5);

        $pdf = new TCPDF('L', PDF_UNIT, [215.9, 330.2], true, 'UTF-8', false); // 8.5 x 13 pulgadas en mm
        $pdf->SetMargins(5, 5, 5);

        // Establecer información del documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema de Vacunación');
        $pdf->SetTitle('Reporte de Pacientes Vacunados - SIGSA5bA');


        // Añadir página
        $pdf->AddPage();

        // Logos
        $pdf->Image(public_path('logos/logo.jpg'), 10, 10, 20);
        $pdf->Image(public_path('logos/logo2.jpg'), 40, 10, 20);

        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 15, 'Reporte de Vacunación - Formulario SIGSA5bA', 0, 1, 'C');
//        $pdf->SetTitle('REGISTRO DE VACUNACION EN OTROS GRUPOS DE POBLACION');

        // Vacuna a la derecha
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetXY(140, 25);
        $pdf->Cell(0, 10, 'Vacuna: ' . $vacuna, 0, 0, 'L');

        // Información del formulario (Código, Versión, Vigencia)
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetY(10);
        $pdf->SetX(-60);
        $pdf->MultiCell(50, 5, "Código: FOR-SIGSA-5bA\nVersión: 3.0\nVigente a partir de: Noviembre 2017", 0, 'R');

        $pdf->Ln(10);

        $pdf->SetFont('helvetica', '', 8);
        $cellWidth = 91;

        // Primera fila de información adicional
        $pdf->Cell($cellWidth, 6, 'Área de Salud: ' . $area_salud, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Distrito de Salud: ' . $distrito_salud, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Municipio: ' . $municipio, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Servicio de Salud: ' . $servicio_salud, 0, 1, 'L');

        // Segunda fila de información adicional
        $pdf->Cell($cellWidth, 6, 'Responsable de la Información: ' . $responsable_informacion, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Cargo: ' . $cargo_responsable, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Año: ' . $anio, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Firma: .......................', 0, 1, 'L');
        $pdf->Ln(5);

        // Definir los anchos de las columnas ajustados
        $columnWidths = [
            'no_orden' => 8,
            'nombre_paciente' => 33,
            'cui' => 19.5,
            'sexo' => 8,
            'pueblo' => 10.5,
            'comunidad_linguistica' => 19,
            'fecha_nacimiento' => 16,
            'discapacidad' => 12,
            'orientacion_sexual' => 12,
            'escolaridad' => 16,
            'profesion_oficio' => 10,
            'comunidad_direccion' => 23,
            'municipio_residencia' => 23,
            'agricola_migrante' => 13,
            'residencia' => 23,
            'embarazada' => 13.5,
            'vacuna' => 17.5,
            'grupo_priorizado' => 17,
            'fecha_administracion' => 15,
            'dosis' => 12,
        ];

        // Agregar los encabezados de las columnas
        $pdf->SetFont('helvetica', 'B', 7);
        $pdf->MultiCell($columnWidths['no_orden'], 7, 'No', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['nombre_paciente'], 7, 'Nombre Paciente', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['cui'], 7, 'CUI', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['sexo'], 7, 'Sexo', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['pueblo'], 7, 'Pueblo', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['comunidad_linguistica'], 7, 'Comunidad Lingüística', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['fecha_nacimiento'], 7, 'Fecha Nac.', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['discapacidad'], 7, 'Discapacidad', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['orientacion_sexual'], 7, 'Orient. Sexual', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['escolaridad'], 7, 'Escolaridad', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['profesion_oficio'], 7, 'Prof./Oficio', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['comunidad_direccion'], 7, 'Comunidad', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['municipio_residencia'], 7, 'Municipio Res.', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['agricola_migrante'], 7, 'Agri. Migrante', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['residencia'], 7, 'Residencia', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['embarazada'], 7, 'Embarazada', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['vacuna'], 7, 'Vacuna', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['grupo_priorizado'], 7, 'Grupo Prior.', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['fecha_administracion'], 7, 'Fecha Admin.', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['dosis'], 7, 'Dosis', 1, 'C', 0, 1);

        // Añadir los datos de los pacientes
        $pdf->SetFont('helvetica', '', 7);
        foreach ($pacientes as $paciente) {
            foreach ($paciente->criteriosVacuna as $criterio) {
                $rowData = [
                    'no_orden' => $paciente->no_orden,
                    'nombre_paciente' => $paciente->nombre_paciente,
                    'cui' => $paciente->cui,
                    'sexo' => $paciente->sexo,
                    'pueblo' => $paciente->pueblo ?? 'N/A',
                    'comunidad_linguistica' => $paciente->comunidad_linguistica ?? 'N/A',
                    'fecha_nacimiento' => $paciente->fecha_nacimiento ? Carbon::parse($paciente->fecha_nacimiento)->format('d-m-Y') : 'N/A',
                    'discapacidad' => $paciente->discapacidad ?? 'N/A',
                    'orientacion_sexual' => $paciente->orientacion_sexual ?? 'N/A',
                    'escolaridad' => $paciente->escolaridad ?? 'N/A',
                    'profesion_oficio' => $paciente->profesion_oficio ?? 'N/A',
                    'comunidad_direccion' => $paciente->residencia->comunidad_direccion ?? 'N/A',
                    'municipio_residencia' => $paciente->residencia->municipio_residencia ?? 'N/A',
                    'agricola_migrante' => $paciente->residencia->agricola_migrante ?? 'N/A',
                    'residencia' => $paciente->residencia->comunidad_direccion ?? 'N/A',
                    'embarazada' => $paciente->residencia->embarazada ?? 'N/A',
                    'vacuna' => $criterio->vacuna ?? 'N/A',
                    'grupo_priorizado' => $criterio->grupo_priorizado ?? 'N/A',
                    'fecha_administracion' => isset($criterio->fecha_administracion) ? Carbon::parse($criterio->fecha_administracion)->format('d-m-Y') : 'N/A',
                    'dosis' => $criterio->dosis ?? 'N/A',
                ];

                // Calculamos la altura máxima de la fila
                $maxHeight = max($this->getMaxRowHeight($pdf, $rowData, $columnWidths), 5);

                // Escribimos cada celda utilizando MultiCell para ajustar la altura
                $pdf->MultiCell($columnWidths['no_orden'], $maxHeight, $rowData['no_orden'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['nombre_paciente'], $maxHeight, $rowData['nombre_paciente'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['cui'], $maxHeight, $rowData['cui'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['sexo'], $maxHeight, $rowData['sexo'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['pueblo'], $maxHeight, $rowData['pueblo'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['comunidad_linguistica'], $maxHeight, $rowData['comunidad_linguistica'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['fecha_nacimiento'], $maxHeight, $rowData['fecha_nacimiento'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['discapacidad'], $maxHeight, $rowData['discapacidad'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['orientacion_sexual'], $maxHeight, $rowData['orientacion_sexual'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['escolaridad'], $maxHeight, $rowData['escolaridad'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['profesion_oficio'], $maxHeight, $rowData['profesion_oficio'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['comunidad_direccion'], $maxHeight, $rowData['comunidad_direccion'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['municipio_residencia'], $maxHeight, $rowData['municipio_residencia'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['agricola_migrante'], $maxHeight, $rowData['agricola_migrante'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['residencia'], $maxHeight, $rowData['residencia'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['embarazada'], $maxHeight, $rowData['embarazada'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['vacuna'], $maxHeight, $rowData['vacuna'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['grupo_priorizado'], $maxHeight, $rowData['grupo_priorizado'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['fecha_administracion'], $maxHeight, $rowData['fecha_administracion'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['dosis'], $maxHeight, $rowData['dosis'], 1, 'C', 0, 1);
            }
        }

        $detect = new MobileDetect();
        if ($detect->isMobile() || $detect->isTablet()) {
            $pdf->Output('reporte_pacientes_5bA.pdf', 'D'); // 'D' descarga el archivo
        } else {
            $pdf->Output('reporte_pacientes_5bA.pdf', 'I'); // 'I' muestra en el navegador
        }
    }
}
