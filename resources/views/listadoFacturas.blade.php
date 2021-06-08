<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado de Facturas</title>
</head>
<body>
<div>
    <div>
        <h1>Listado de Facturas</h1>
    </div>
    <div>

        @if($facturas->isEmpty())
            <h3>No hay facturas en la Base de Datos</h3>
        @else
            <table class="table" border="1">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Precio Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($facturas as $factura)
                    <tr>
                        <td>{!! $factura->id !!}</td>
                        <td>{!! $factura->fecha !!}</td>
                        <td>{!! $factura->descripcion !!}</td>
                        <td>{!! $factura->precioTotal !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
</html>
