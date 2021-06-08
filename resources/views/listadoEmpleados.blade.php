<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado de Empleados</title>
</head>
<body>
<div>
    <div>
        <h1>Listado de Empleados</h1>
    </div>
    <div>

        @if($empleados->isEmpty())
            <h3>No hay empleados en la Base de Datos</h3>
        @else
            <table class="table" border="1">
                <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Estudios</th>
                </tr>
                </thead>
                <tbody>
                @foreach($empleados as $empleado)
                    <tr>
                        <td>{!! $empleado->dni !!}</td>
                        <td>{!! $empleado->nombre !!}</td>
                        <td>{!! $empleado->apellidos !!}</td>
                        <td>{!! $empleado->direccion !!}</td>
                        <td>{!! $empleado->telefono !!}</td>
                        <td>{!! $empleado->estudios !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
</html>

