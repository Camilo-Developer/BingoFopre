@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Panel Administrativo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Panel Administrativo</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <style>
        .select2-container--default .select2-selection--single{
            height: 37px!important;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <h5 class="mb-2">Asignación o Modificación rápida de grupos de cartones por usuario:</h5>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 d-flex">
                        <select id="userSelect" class="form-control">
                            <option value=""></option> <!-- Agrega una opción en blanco -->
                            @foreach ($users as $user)
                                <option value="{{ route('admin.users.show', $user->id) }}">{{$user->email}} </option>
                            @endforeach
                        </select>
                        <button title="Buscar" id="goButton" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <h5 class="mb-2">Información general año: {{$year}}</h5>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-receipt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Cartones</span>
                            <span class="info-box-number">{{$allCardboard}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fa fa-layer-group"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Grupos de Cartones</span>
                            <span class="info-box-number">{{$allCartonGroup}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Usuarios</span>
                            <span class="info-box-number">{{$allUser}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-chart-pie"></i> Gráficas generales de ventas</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="col-12">
                                        <label>Total de cartones creados en el año: {{$year}}</label>
                                    </div>
                                    <div class="col-12">
                                        <canvas id="cartonGrap"></canvas>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="col-12">
                                        <label>Filtro por fecha de total de cartones vendidos</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">Fecha inicio</label>
                                            <input type="date" id="startDate" class="form-control" placeholder="Fecha de inicio">
                                        </div>
                                        <div class="col-5">
                                            <label for="">Fecha fin</label>
                                            <input type="date" id="endDate" class="form-control" placeholder="Fecha de fin">
                                        </div>
                                        <div class="col-2">
                                            <br>
                                            <button id="filterButton" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="chart-container">
                                            <canvas id="graficaBarra"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Monto total de cartones por Día: Vendidos + Obsequio</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body" style="display: block;">
                                            <canvas id="monto_cartones_total_por_dias"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Total de cartones por Día: Vendidos + Obsequio</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body" style="display: block;">
                                            <canvas id="total_cartones_vendido_obsequio"></canvas>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-12 col-lg-6">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Monto total de cartones por Día: Vendidos</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body" style="display: block;">
                                            <canvas id="monto_Vendido_total_dia"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Total de cartones por Día: Vendidos</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body" style="display: block;">
                                            <canvas id="total_cartones_vendidos_users"></canvas>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Monto total de cartones por Día: Obsequio</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body" style="display: block;">
                                            <canvas id="monto_Obsequio_total_dia"></canvas>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Total de cartones por Día: Obsequio</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body" style="display: block;">
                                            <canvas id="total_cartones_obsequio_users"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <script>
        var ctx = document.getElementById('cartonGrap').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Cartones Creados', 'Cartones Vendidos','Cartones Obsequio'],
                datasets: [{
                    data: [{{ $allCardboard }}, {{ $caronesVendidos }},{{$caronesObsequio}}],
                    backgroundColor: [
                        'rgb(75, 192, 192)', // Color para Cartones Asignados
                        'rgb(255, 99, 132)',  // Color para Cartones Pendientes
                        'rgb(46,217,54)',  // Color para Cartones Pendientes
                    ]
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
                                return previousValue + currentValue;
                            });
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = ((currentValue / total) * 100).toFixed(2) + "%";
                            return data.labels[tooltipItem.index] + ": " + currentValue + " (" + percentage + ")";
                        }
                    }
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Inicializar el select2 con opciones mínimas
            $('#userSelect').select2({
                minimumInputLength: 1, // Comenzar la búsqueda después de ingresar al menos 1 carácter
                placeholder: "Buscar usuario..."
            });

            // Manejar el evento clic del botón "Ir"
            $('#goButton').on('click', function() {
                var selectedUrl = $('#userSelect').val(); // Obtener la URL seleccionada
                if (selectedUrl) {
                    window.location.href = selectedUrl; // Redireccionar al usuario seleccionado
                }
            });
        });
    </script>

    <script>
        // Obtén el contexto del lienzo (canvas) para la gráfica de barras
        var ctxBarra = document.getElementById('graficaBarra').getContext('2d');

        // Define los datos para la gráfica de barras
        var dataBarra = {
            labels: ['Cartones Creados', 'Cartones Vendidos', 'Catones Obsequio'],
            datasets: [
                {
                    label: 'Cartones Creados',
                    data: [{{ $cartonFilter }}, 0 , 0], // Inicialmente, el total de vendidos es 0
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Cartones Vendidos',
                    data: [0, {{ $caronesVendidosFilter }} , 0], // Inicialmente, el total de creados es 0
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Cartones Obsequio',
                    data: [ 0,0, {{ $caronesObsequioFilter }}], // Inicialmente, el total de creados es 0
                    backgroundColor: 'rgba(99,235,54,0.2)',
                    borderColor: 'rgb(223,235,54)',
                    borderWidth: 1
                }
            ]
        };

        var optionsBarra = {
            scales: {
                y: {
                    beginAtZero: false // No comiences el eje Y en cero
                }
            }
        };

        // Crea la gráfica de barras
        var myBarChart = new Chart(ctxBarra, {
            type: 'bar', // Tipo de gráfica
            data: dataBarra, // Datos de la gráfica
            options: optionsBarra // Opciones de configuración
        });

        // Agregar evento de clic al botón de filtro
        document.getElementById('filterButton').addEventListener('click', function () {
            var startDate = document.getElementById('startDate').value;
            var endDate = document.getElementById('endDate').value;
            // Redirigir a la acción 'index' del controlador actual con los parámetros de fecha
            window.location.href = '/admin/dashboard?startDate=' + startDate + '&endDate=' + endDate;
        });
    </script>



    <script>
        var ctx = document.getElementById('total_cartones_vendido_obsequio').getContext('2d');

        // Obtén los datos de cartones vendidos por día desde PHP
        var cartonesPorDiaData = @json($total_cartones_obsequio_y_vendidos);

        // Separa las fechas y los totales en dos arreglos
        var fechas = cartonesPorDiaData.map(function (item) {
            return item.sold_date;
        });

        var cantidades = cartonesPorDiaData.map(function (item) {
            return item.total_cartones_vendidos;
        });

        var data = {
            labels: fechas,
            datasets: [{
                label: 'Total cartones Obsequio por día',
                data: cantidades,
                backgroundColor: 'rgba(54,235,160,0.2)',
                borderColor: 'rgb(54,235,138)',
                borderWidth: 1
            }]
        };

        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>
    <script>
        var ctx = document.getElementById('total_cartones_vendidos_users').getContext('2d');

        // Obtén los datos de cartones vendidos por día desde PHP
        var cartonesPorDiaData = @json($total_cartones_vendidos_users);

        // Separa las fechas y los totales en dos arreglos
        var fechas = cartonesPorDiaData.map(function (item) {
            return item.sold_date;
        });

        var cantidades = cartonesPorDiaData.map(function (item) {
            return item.total_cartones_vendidos;
        });

        var data = {
            labels: fechas,
            datasets: [{
                label: 'Total cartones Obsequio por día',
                data: cantidades,
                backgroundColor: 'rgba(54,235,160,0.2)',
                borderColor: 'rgb(54,235,138)',
                borderWidth: 1
            }]
        };

        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>
    <script>
        var ctx = document.getElementById('total_cartones_obsequio_users').getContext('2d');

        // Obtén los datos de cartones vendidos por día desde PHP
        var cartonesPorDiaData = @json($total_cartones_obsequio_users);

        // Separa las fechas y los totales en dos arreglos
        var fechas = cartonesPorDiaData.map(function (item) {
            return item.sold_date;
        });

        var cantidades = cartonesPorDiaData.map(function (item) {
            return item.total_cartones_vendidos;
        });

        var data = {
            labels: fechas,
            datasets: [{
                label: 'Total cartones Obsequio por día',
                data: cantidades,
                backgroundColor: 'rgba(54,235,160,0.2)',
                borderColor: 'rgb(54,235,138)',
                borderWidth: 1
            }]
        };

        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>



    <script>
        var ctx = document.getElementById('monto_cartones_total_por_dias').getContext('2d');

        // Obtén los datos de montos vendidos por día desde PHP
        var montoPorDiaData = @json($montoVendido_total_dia);

        // Separa las fechas y los montos en dos arreglos
        var fechas = montoPorDiaData.map(function (item) {
            return item.sold_date;
        });
        //console.log(montoPorDiaData);

        var montos = montoPorDiaData.map(function (item) {
            return item.total_monto;
        });

        var data = {
            labels: fechas,
            datasets: [{
                label: 'Monto total cartones Vendidos y Obsequio por día',
                data: montos,
                fill: false,
                borderColor: 'rgb(27,234,117)',
                tension: 0.4
            }]
        };

        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    </script>


    <script>
        var ctx = document.getElementById('monto_Vendido_total_dia').getContext('2d');

        // Obtén los datos de montos vendidos por día desde PHP
        var montoPorDiaData = @json($monto_Vendido_total_dia);

        // Separa las fechas y los montos en dos arreglos
        var fechas = montoPorDiaData.map(function (item) {
            return item.sold_date;
        });
        //console.log(montoPorDiaData);

        var montos = montoPorDiaData.map(function (item) {
            return item.total_monto;
        });

        var data = {
            labels: fechas,
            datasets: [{
                label: 'Monto total cartones Vendidos y Obsequio por día',
                data: montos,
                fill: false,
                borderColor: 'rgb(27,234,117)',
                tension: 0.4
            }]
        };

        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    </script>
    <script>
        var ctx = document.getElementById('monto_Obsequio_total_dia').getContext('2d');

        // Obtén los datos de montos vendidos por día desde PHP
        var montoPorDiaData = @json($monto_Obsequio_total_dia);

        // Separa las fechas y los montos en dos arreglos
        var fechas = montoPorDiaData.map(function (item) {
            return item.sold_date;
        });
        //console.log(montoPorDiaData);

        var montos = montoPorDiaData.map(function (item) {
            return item.total_monto;
        });

        var data = {
            labels: fechas,
            datasets: [{
                label: 'Monto total cartones Vendidos y Obsequio por día',
                data: montos,
                fill: false,
                borderColor: 'rgb(27,234,117)',
                tension: 0.4
            }]
        };

        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    </script>



@endsection
