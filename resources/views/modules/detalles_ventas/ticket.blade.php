<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket de compra</title>
    <style>
        body {
            font-family: Arial;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }

        .ticket {
            width: 270px;
            padding: auto;
        }

        .titulo {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .detalle {
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            padding: 2px 0;
            border-bottom: 1px dashed #000;
            text-align: left;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
            font-size: 13px;
        }

        .gracias {
            text-align: center;
            margin-top: 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="titulo">Ticket de compra - Facultad Autodidacta</div>

        <p><strong>Cajero:</strong> {{ $venta->nombre_usuario }}</p>
        <p><strong>Fecha:</strong> {{ $venta->created_at }}</p>

        <div class="detalle">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Precio</th>
                        <th>Subt.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $item)
                        <tr>
                            <td>{{ $item->nombre_producto }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>${{ number_format($item->precio_unitario, 2) }}</td>
                            <td>${{ number_format($item->sub_total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p class="total">Total: ${{ number_format($venta->total_venta, 2) }}</p>

        <p class="gracias">¡Gracias por su compra!</p>
    </div>
</body>
</html>
