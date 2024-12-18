<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes Vacunados SIGSA 5bA</title>
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
<h1>Pacientes Vacunados</h1>
<p>Vacuna: {{ $vacuna }}</p>
<p>Mes: {{ $mes }} / Año: {{ $anio }}</p>

<table>
    <thead>
    <tr>
        <th>Paciente</th>
        <th>CUI</th>
        <th>Municipio</th>
        <th>Vacuna</th>
        <th>Dosis</th>
        <th>Fecha de Administración</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pacientes as $paciente)
        @foreach($paciente->criteriosVacuna as $criterio)
            <tr>
                <td>{{ $paciente->nombre_paciente }}</td>
                <td>{{ $paciente->cui }}</td>
                <td>{{ $paciente->residencia->municipio_residencia }}</td>
                <td>{{ $criterio->vacuna }}</td>
                <td>{{ $criterio->dosis }}</td>
                <td>{{ $criterio->fecha_administracion }}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
</body>
</html>
