@extends('layouts.guest')
@section('title','Panel administrativo')
@section('content')
    <section class="pt-1 pb-4">
        <style>
            .moving-tab{
                display: none!important;
            }
        </style>
        <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-12 col-md-12 col-12 mx-auto text-center">
                        <div class="nav-wrapper mt-5 position-relative z-index-2">
                            <ul class="nav nav-pills nav-fill flex-row p-1" id="tabs-pricing" role="tablist">
                                @can('users.dashboard.admin.stundents')

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 active" id="tabs-iconpricing-tab-1" data-bs-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="true">
                                        Estadisticas
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
                        </div>
                    @endcan

                     @can('users.dashboard.admin.seller')
                        <div class="tab-pane" id="seller" role="tabpanel" aria-labelledby="#tabs-iconpricing-tab-3">
                            <div class="row">
                                <div class="col-12">
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
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="table-responsive">
                                                <h5 class="font-weight-bolder ">Grupos de Cartones Asignados por Vender</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Grupo</th>
                                                            <th scope="col">Tol. Cart</th>
                                                            <th scope="col">Pend. Cart</th>
                                                            <th scope="col">Estado</th>
                                                            <th scope="col">Accion</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($card_groups as $card_group)
                                                            @php
                                                                $totalCartones2 = $card_group->cardboard_count;
                                                                $cartones_vendidos2 = $card_group->cardboards_vendidos;
                                                                $cartones_obsequio2 = $card_group->cardboards_obsequio;

                                                                $totalCartones_pendientes2 = $totalCartones2 - ($cartones_vendidos2 + $cartones_obsequio2);
                                                            @endphp
                                                            <tr class="text-center">
                                                                <td>
                                                                    <input type="hidden" name="carton_group_state" value="{{$card_group->id}}" >
                                                                    {{$card_group->id}}
                                                                </td>
                                                                <td>{{$totalCartones2}}</td>
                                                                <td>{{$totalCartones_pendientes2}}</td>
                                                                <td>
                                                                    {{$card_group->state->name}}
                                                                </td>
                                                                <td>
                                                                    <a data-bs-toggle="modal" data-bs-target="#modal-datail-group_{{$loop->iteration}}" title="Detalle del grupo">
                                                                        <button  type="button" class="btn btn-success">
                                                                            <i class="fa fa-eye"></i>
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                {{ $card_groups->links() }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <canvas id="miGrafica2"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <h5 class="font-weight-bolder ">Historial de grupos de cartones Año {{$currentYear}}</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr class="text-center">
                                                <th scope="col">Grupo</th>
                                                <th scope="col">Tol. Cart</th>
                                                <th scope="col">Pend. Cart</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($card_groups_shows as $card_groups_show)
                                                @php
                                                    $totalCartones4 = $card_groups_show->cardboard_count;
                                                    $cartones_vendidos4 = $card_groups_show->cardboards_vendidos;
                                                    $cartones_obsequio4 = $card_groups_show->cardboards_obsequio;

                                                    $totalCartones_pendientes4 = $totalCartones4 - ($cartones_vendidos4 + $cartones_obsequio4);
                                                @endphp
                                                <tr class="text-center">
                                                    <td>{{$card_groups_show->id}}</td>
                                                    <td>{{$totalCartones4}}</td>
                                                    <td>{{$totalCartones_pendientes4}}</td>
                                                    <td>{{$card_groups_show->state->name}}</td>
                                                    <td>
                                                        <a data-toggle="modal" data-target="#modal-datail-group_year_{{$loop->iteration}}" title="Detalle del grupo">
                                                            <button  type="button" class="btn btn-success">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>





                    @endcan
                </div>
            </div>
    </section>


    @foreach($card_groups as $card_group)
        @php
            $totalCartones3 = $card_group->cardboard_count;
            $cartones_vendidos3 = $card_group->cardboards_vendidos;
            $cartones_obsequio3 = $card_group->cardboards_obsequio;

            $totalCartones_pendientes3 = $totalCartones3 - ($cartones_vendidos3 + $cartones_obsequio3);
        @endphp

        <div class="modal fade" id="modal-datail-group_{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detalle del grupo</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="username">Usuario Responsable</label><br>
                                            <input class="form-control form-control-border" type="text" disabled value="{{-- $user->name --}}" id="username">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="group">Grupo</label><br>
                                            <input class="form-control form-control-border" type="text" disabled value="{{ $card_group->id }}" id="group">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="group">Estado</label><br>
                                            <input class="form-control form-control-border" type="text" disabled value="{{ $card_group->state->name }}" id="group">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="group">Total Cartones</label><br>
                                            <input class="form-control form-control-border" type="text" disabled value="{{ $totalCartones3 }}" id="group">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="group">Total Pendientes por Vender</label><br>
                                            <input class="form-control form-control-border" type="text" disabled value="{{ $totalCartones_pendientes3 }}" id="group">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                <tr class="text-center">
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nombre Carton</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $cartonNumber = 1; // Inicializar el número de cartón
                                                @endphp
                                                @foreach ($card_group->cardboard as $carton)
                                                    <tr class="text-center">
                                                        <td>{{ $cartonNumber }}</td>
                                                        <td>{{ $carton->name }}</td>
                                                        <td>{{ $carton->state->name }}</td>
                                                        <td>
                                                            <a href="/admin/cartones/create?search={{ $carton->name }}" class="btn btn-success">
                                                                <i class="fa fa-search"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $cartonNumber++;
                                                    @endphp
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @foreach($card_groups_shows as $card_groups_show)
        @php
            $totalCartones5 = $card_groups_show->cardboard_count;
            $cartones_vendidos5 = $card_groups_show->cardboards_vendidos;
            $cartones_obsequio5 = $card_groups_show->cardboards_obsequio;
            $totalCartones_pendientes5 = $totalCartones5 - ($cartones_vendidos5 + $cartones_obsequio5);
        @endphp
        <div class="modal fade" id="modal-datail-group_year_{{$loop->iteration}}"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detalle del grupo por el año </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="username">Usuario Responsable</label><br>
                                            <input class="form-control form-control-border" type="text" disabled value="{{-- $user->name --}} {{-- $user->lastname --}}" id="username">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="group">Grupo</label><br>
                                            <input class="form-control form-control-border" type="text" disabled value="{{ $card_groups_show->id }}" id="group">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="group">Estado</label><br>
                                            <input class="form-control form-control-border" type="text" disabled value="{{ $card_groups_show->state->name }}" id="group">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="group">Total Cartones</label><br>
                                            <input class="form-control form-control-border" type="text" disabled value="{{ $totalCartones5 }}" id="group">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="group">Total Pendientes por Vender</label><br>
                                            <input class="form-control form-control-border" type="text" disabled value="{{ $totalCartones_pendientes5 }}" id="group">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                <tr class="text-center">
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nombre Carton</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $cartonNumber_two = 1;
                                                @endphp
                                                @foreach ($card_groups_show->cardboard as $carton)
                                                    <tr class="text-center">
                                                        <td>{{ $cartonNumber_two }}</td>
                                                        <td>{{ $carton->name }}</td>
                                                        <td>{{ $carton->state->name }}</td>
                                                        <td>
                                                            <a href="/admin/cartones/create?search={{ $carton->name }}" class="btn btn-success">
                                                                <i class="fa fa-search"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $cartonNumber_two++;
                                                    @endphp
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

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
        var ctx = document.getElementById('miGrafica2').getContext('2d');
        var data = {
            labels: ['Car. Vendidos', 'Car. Obsequio', 'Sum. Ven + Obs', 'Tol. Grupos'],
            datasets: [{
                label: 'Precio de la Acción',
                data: [{{ $totalMontoVendido }}, {{$totalMontoObsequio}},{{$sumademontos}}, {{$totalMontoGrupo}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(49,220,169,0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgb(31,185,85)',
                ],
                borderWidth: 1
            }]
        };
        var options = {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        };
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>

@endsection
