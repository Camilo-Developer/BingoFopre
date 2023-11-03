<!-- resources/views/sales_report.blade.php -->
<html>
<head>
    <title>Reporte de Ventas</title>
</head>
<body>
<h2>Reporte de Ventas</h2>
<table>
    <thead>
    <tr >
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Nombre Cartón</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Precio Cartón</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Documento del Comprador</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Categoria Principal del Comprador</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Categoria C del Comprador</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Categoria Administrativa del Comprador</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Nombre del Comprador</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Apellido del Comprador</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Correo Electronico del Comprador</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Genero del Comprador</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Tipo de Identificacion del Comprador</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Telefono Celular del Comprador</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Fecha Venta</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Modo de Venta</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Estado del Cartón</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Grupo del Cartón</th>
        <th style="text-align:center;background:#b3dba3; border: 2px solid black;">Correo Usuario Vendedor del Cartón</th>
        <!-- Agrega más columnas según tus necesidades -->
    </tr>
    </thead>
    <tbody>
    @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->name }}</td>
            <td>{{ $sale->price }}</td>
            <td>{{ $sale->document_number ?? 'N/A'}}</td>
            <td>{{ $sale->Categoria_Principal__c ?? 'N/A'}}</td>
            <td>{{ $sale->Categoria__c ?? 'N/A'}}</td>
            <td>{{ $sale->Categoria_Administrativo__c ?? 'N/A'}}</td>
            <td>{{ $sale->FirstName ?? 'N/A'}}</td>
            <td>{{ $sale->LastName ?? 'N/A'}}</td>
            <td>{{ $sale->Email ?? 'N/A'}}</td>
            <td>{{ $sale->generoEmail__c ?? 'N/A'}}</td>
            <td>{{ $sale->Tipo_identificaci_n__c ?? 'N/A'}}</td>
            <td>{{ $sale->Tel_fono_celular_1__c ?? 'N/A'}}</td>
            <td>{{ $sale->sold_date ?? 'N/A'}}</td>
            <td>{{ $sale->mode_sale ?? 'Presencial'}}</td>
            <td>{{ $sale->state->name }}</td>
            <td>{{ $sale->group_id }}</td>
            <td>{{ $sale->user->email ?? 'N/A' }}</td>
            <!-- Agrega más columnas según tus necesidades -->
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
