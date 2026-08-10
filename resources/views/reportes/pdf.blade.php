<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Incidencias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #006039;
            padding-bottom: 10px;
        }
        .header h2 {
            color: #006039;
            margin: 0;
            padding: 0;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #006039;
            color: white;
            padding: 8px;
            text-align: left;
        }
        td {
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Colegio de Bachilleres</h2>
        <p><strong>Reporte Oficial de Incidencias del Personal</strong></p>
        <p>Fecha de Generación: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Matrícula</th>
                <th>Empleado</th>
                <th>Departamento</th>
                <th>Tipo de Incidencia</th>
                <th>Motivo</th>
                <th>Estatus</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incidencias as $incidencia)
            <tr>
                <td>{{ $incidencia->id }}</td>
                <td>{{ \Carbon\Carbon::parse($incidencia->fecha)->format('d/m/Y') }}</td>
                <td>{{ $incidencia->empleado->numero_empleado }}</td>
                <td>{{ $incidencia->empleado->nombre }} {{ $incidencia->empleado->apellido_paterno }}</td>
                <td>{{ $incidencia->departamento->nombre ?? 'N/A' }}</td>
                <td>{{ $incidencia->tipoIncidencia->nombre ?? 'N/A' }}</td>
                <td>{{ $incidencia->motivo ?? '-' }}</td>
                <td>{{ $incidencia->estatus }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
