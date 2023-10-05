@extends('layouts.guest')
@section('title','Panel administrativo')
@section('content')
    <section class="pt-3 pb-4">
        <style>
            .moving-tab{
                display: none!important;
            }
        </style>
        <div class="">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-12 col-md-12 col-12 mx-auto text-center">
                        <div class="nav-wrapper mt-5 position-relative z-index-2">
                            <ul class="nav nav-pills nav-fill flex-row p-1" id="tabs-pricing" role="tablist">
                                @can('users.dashboard.admin.stundents')

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 active" id="tabs-iconpricing-tab-1" data-bs-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="true">
                                        Gráficas
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0" id="tabs-iconpricing-tab-2" data-bs-toggle="tab" href="#annual" role="tab" aria-controls="annual" aria-selected="false" tabindex="-1">
                                        Información General
                                    </a>
                                </li>
                                @endcan

                                @can('users.dashboard.admin.seller')
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link mb-0" id="tabs-iconpricing-tab-3" data-bs-toggle="tab" href="#seller" role="tab" aria-controls="seller" aria-selected="false" tabindex="-1">
                                            Información Vendedor
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content tab-space">
                    @can('users.dashboard.admin.stundents')

                        <div class="tab-pane active show" id="monthly" role="tabpanel" aria-labelledby="#tabs-iconpricing-tab-1">
                            <canvas id="miGrafica"></canvas>

                        </div>
                        <div class="tab-pane" id="annual" role="tabpanel" aria-labelledby="#tabs-iconpricing-tab-2">
                            <canvas id="miGrafica2"></canvas>
                        </div>
                    @endcan

                     @can('users.dashboard.admin.seller')
                        <div class="tab-pane" id="seller" role="tabpanel" aria-labelledby="#tabs-iconpricing-tab-3">
                            <div  id="count-stats">
                                    <div class="row">
                                        <div class="col-lg-9 z-index-2 border-radius-xl mx-auto py-3">
                                            <div class="row">
                                                <div class="col-md-3 position-relative">
                                                    <div class="p-3 text-center">
                                                        <h1 class="text-gradient text-primary"><span id="state1" countto="{{ $totalCartonesAsignados }}">{{ $totalCartonesAsignados }}</span></h1>
                                                        <h5 class="mt-3">Cartones Asignado</h5>
                                                    </div>
                                                    <hr class="vertical dark">
                                                </div>
                                                <div class="col-md-3 position-relative">
                                                    <div class="p-3 text-center">
                                                        <h1 class="text-gradient text-primary"> <span id="state2" countto="{{ $totalCartonesVendidos }}">{{ $totalCartonesVendidos }}</span></h1>
                                                        <h5 class="mt-3">Cartones Vendidos</h5>
                                                    </div>
                                                    <hr class="vertical dark">
                                                </div>
                                                <div class="col-md-3 position-relative">
                                                    <div class="p-3 text-center">
                                                        <h1 class="text-gradient text-primary" id="state3" countto="{{ $totalCartonesPendientes }}">{{ $totalCartonesPendientes }}</h1>
                                                        <h5 class="mt-3">Cartones Pendientes</h5>
                                                    </div>
                                                    <hr class="vertical dark">
                                                </div>
                                                <div class="col-md-3 position-relative">
                                                    <div class="p-3 text-center">
                                                        <h1 class="text-gradient text-primary" id="state3" countto="{{ $totalCartonesObsequios }}">{{ $totalCartonesObsequios }}</h1>
                                                        <h5 class="mt-3">Cartones Obsequio</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    @endcan

                </div>
            </div>
        </div>
    </section>



@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script>
        // Obtén el contexto del lienzo (canvas)
        var ctx = document.getElementById('miGrafica').getContext('2d');

        // Define los datos para la gráfica (precios de una acción a lo largo del tiempo)
        var data = {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Precio de la Acción',
                data: [100, 110, 105, 120, 130, 125],
                fill: false, // No rellenes el área bajo la línea
                borderColor: 'rgb(75, 192, 192)', // Color de la línea
                tension: 0.4 // Tensión de la línea (0 para una línea recta, 1 para una curva suave)
            }]
        };

        // Configura la opción de la gráfica
        var options = {
            scales: {
                y: {
                    beginAtZero: false // No comiences el eje Y en cero
                }
            }
        };

        // Crea la gráfica de líneas
        var myChart = new Chart(ctx, {
            type: 'line', // Tipo de gráfica
            data: data, // Datos de la gráfica
            options: options // Opciones de configuración
        });
    </script>

    <script>
        // Obtén el contexto del lienzo (canvas)
        var ctx = document.getElementById('miGrafica2').getContext('2d');

        // Define los datos para la gráfica de barras
        var data = {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Precio de la Acción',
                data: [100, 110, 105, 120, 130, 125],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', // Color de fondo de la primera barra
                    'rgba(54, 162, 235, 0.2)', // Color de fondo de la segunda barra
                    'rgba(255, 206, 86, 0.2)', // Color de fondo de la tercera barra
                    'rgba(75, 192, 192, 0.2)', // Color de fondo de la cuarta barra
                    'rgba(153, 102, 255, 0.2)', // Color de fondo de la quinta barra
                    'rgba(255, 159, 64, 0.2)'  // Color de fondo de la sexta barra
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // Color del borde de la primera barra
                    'rgba(54, 162, 235, 1)', // Color del borde de la segunda barra
                    'rgba(255, 206, 86, 1)', // Color del borde de la tercera barra
                    'rgba(75, 192, 192, 1)', // Color del borde de la cuarta barra
                    'rgba(153, 102, 255, 1)', // Color del borde de la quinta barra
                    'rgba(255, 159, 64, 1)'  // Color del borde de la sexta barra
                ],
                borderWidth: 1 // Ancho del borde de las barras
            }]
        };

        // Configura la opción de la gráfica
        var options = {
            scales: {
                y: {
                    beginAtZero: false // No comiences el eje Y en cero
                }
            }
        };

        // Crea la gráfica de barras
        var myChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfica
            data: data, // Datos de la gráfica
            options: options // Opciones de configuración
        });
    </script>
@endsection
