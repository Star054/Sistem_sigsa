<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Vacunación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h1>Pacientes Vacunados con {{ $vacuna }} en {{ \Carbon\Carbon::create()->month($mes)->year($anio)->format('F, Y') }}</h1>

<table>
    <thead>
    <tr>
        <th>No. Orden</th>
        <th>Nombre del Paciente</th>
        <th>CUI</th>
        <th>Municipio</th>
        <th>Vacuna</th>
        <th>Fecha de Vacunación</th>
        <th>Tipo de Dosis</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pacientes as $index => $paciente)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $paciente->nombre }}</td>
            <td>{{ $paciente->cui }}</td>
            <td>{{ $paciente->municipio }}</td>
            <td>{{ $vacuna }}</td>
            <td>{{ $paciente->vacunacion->fecha_vacunacion }}</td>
            <td>{{ $paciente->vacunacion->dosis }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<form action="{{ route('vacunas.generarPDF') }}" method="POST">
    @csrf
    <input type="hidden" name="vacuna" value="{{ $vacuna }}">
    <input type="hidden" name="mes" value="{{ request()->input('mes') }}">
    <input type="hidden" name="tipo_formulario" value="{{ $tipoFormulario }}">
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-500">
        Generar PDF
    </button>
</form>



</body>
</html>
