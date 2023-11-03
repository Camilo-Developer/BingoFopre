<!-- resources/views/sales_detail_report.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Detalle del Reporte de Ventas</title>
</head>
<body>
<h1>Detalle del Reporte de Ventas</h1>

<h2>Cartones Creados</h2>
<table>
    <thead>
    <tr>
        <th>Total de Cartones Creados</th>
        <th>Monto Total</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $totalCartonesCreados }}</td>
        <td colspan="1">{{ $montoCartonesCreados }}</td>
    </tr>
    </tbody>
</table>

<h2>Cartones Vendidos</h2>
<table>
    <thead>
    <tr>
        <th>Total de Cartones Vendidos</th>
        <th>Monto Total Vendido</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $totalCartonesVendidos }}</td>
        <td colspan="1">{{ $montoCartonesVendidos }}</td>
    </tr>
    </tbody>
</table>

<h2>Cartones Obsequio</h2>
<table>
    <thead>
    <tr>
        <th>Total de Cartones Obsequio</th>
        <th>Monto Total Obsequio</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $totalCartonesObsequio }}</td>
        <td colspan="1">{{ $montoCartonesObsequio }}</td>
    </tr>
    </tbody>
</table>

<h2>Cartones Restantes</h2>
<table>
    <thead>
    <tr>
        <th>Total de Restantes por Vender</th>
        <th>Monto Total Restante</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $totalCartonesRestantes }}</td>
        <td colspan="1">{{ $montoCartonesRestantes }}</td>
    </tr>
    </tbody>
</table>

</body>
</html>
