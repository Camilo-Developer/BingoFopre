@extends('layouts.app')
@section('title', 'Detalle del usuario')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detalle del usuario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Usuario</a></li>
                        <li class="breadcrumb-item active">Detalle del usuario</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Información del Usuario</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="card card-widget widget-user">

                                            <div class="widget-user-header bg-info">
                                                <h3 class="widget-user-username">{{$user->name}} {{$user->lastname}}</h3>
                                                <h5 class="widget-user-desc">{{$user->email}}</h5>
                                            </div>

                                            <div class="widget-user-image">
                                                <img class="img-circle elevation-2" src="data:image/jpeg;base64,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" alt="User Avatar">
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="text-center font-weight-bold">
                                                            @foreach ($user->roles as $role)
                                                                {{ $role->name }}
                                                                @if (!$loop->last)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">{{$totalCartonesAsignados}}</h5>
                                                            <span class="description-text">Cartones Asignados</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">{{$totalCartonesVendidos}}</h5>
                                                            <span class="description-text">Cartones vendidos</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="description-block">
                                                            <h5 class="description-header">{{$totalCartonesObsequios}}</h5>
                                                            <span class="description-text">Cartones Obsequio</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-footer">
                                                        <div class="row">
                                                            <div class="col-sm-3 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">{{$totalGruposAsignados}}</h5>
                                                                    <span class="description-text">Grupos Asignados</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">$ {{number_format(intval($totalMontoGrupo))}}</h5>
                                                                    <span class="description-text">Precio Total Grupos Asiginados</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">$ {{number_format(intval($totalMontoVendido))}}</h5>
                                                                    <span class="description-text">Monto total Cartones Vendidos</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">$ {{number_format(intval($totalMontoObsequio))}}</h5>
                                                                    <span class="description-text">Monto Total Cartones Obsequio</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <canvas id="pieChart"></canvas>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <canvas id="miGrafica2"></canvas>
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
        <section class="content pb-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Historial del Usuario</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <label>Grupos Asginados hasta el momento: </label>
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
                                                            <a data-toggle="modal" data-target="#modal-datail-group_{{$loop->iteration}}" title="Detalle del grupo">
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
                                    <div class="col-12 col-lg-6">
                                        <label>Total de Grupos Asginados año: {{$currentYear}}</label>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container d-flex justify-content-end align-items-end">
            <input type="checkbox" id="btn-mas">

            <div class="redes" style="margin-bottom: 61px;margin-right: -55px;">
                @can('admin.users.asiginacionGrupos')
                <a style="cursor: pointer;" title="Asignar Grupos Disponibles" class="fa fa-check-circle" data-toggle="modal" data-target="#modal-asign-groups"></a>
                @endcan
                @can('admin.users.cambioStateGruposCartones')
                    <a data-toggle="modal" data-target="#modal-cambio-state-groups" href="#" class="fas fa-edit" title="Editar Grupos Asignados"></a>
                @endcan

            </div>
            <div class="btn-mas">
                <label for="btn-mas" class="fa fa-plus"></label>
            </div>
        </div>
        @can('admin.users.asiginacionGrupos')
        <div class="modal fade" id="modal-asign-groups"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Asignación de Grupos Disponibles</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.users.asiginacionGrupos') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user_id">Asignar cartones al usuario</label><br>
                                <input type="hidden" value="{{ $user->id }}" name="user_id">
                                <input class="form-control form-control-border" type="text" disabled value="{{ $user->name }} {{ $user->lastname }}" id="user_id">
                            </div>
                            <label>Grupo de cartones disponibles</label>
                            <div style="max-height: 250px; overflow-y: scroll;">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr class="text-center">
                                            <th scope="col">Grupo</th>
                                            <th scope="col">Total Cartones</th>
                                            <th scope="col">Cartones Pendientes por Vender</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Asignar</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($grupo_cartones as $grupo)
                                            @php
                                            $totalCartones = $grupo->cardboard_count;
                                            $cartones_vendidos = $grupo->cardboards_vendidos;
                                            $cartones_obsequio = $grupo->cardboards_obsequio;

                                            $totalCartones_pendientes = $totalCartones - ($cartones_vendidos + $cartones_obsequio);
                                            @endphp
                                            <tr class="text-center">
                                                <td>
                                                    {{ $grupo->id }}
                                                </td>
                                                <td>
                                                    {{$totalCartones}}
                                                </td>
                                                <td>{{$totalCartones_pendientes}}</td>
                                                <td>{{$grupo->state->name}}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="{{ $grupo->id }}" name="grupo_cartones[]">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Asignar grupos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endcan
        @can('admin.users.cambioStateGruposCartones')
        <div class="modal fade" id="modal-cambio-state-groups"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Grupos de Cartones Asignados: Circulación</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.users.cambioStateGruposCartones') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <th scope="col">Grupo</th>
                                        <th scope="col">Total Cartones</th>
                                        <th scope="col">Total Cartones Pendientes por Perder</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acción</th>
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
                                                <div class="form-check">
                                                    <input class="form-check-input" value="{{$card_group->id}}" name="state_groups[]" type="checkbox">
                                                    <label class="form-check-label">Vendido</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-warning">Cambiar Estado</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        @endcan

        @foreach($card_groups as $card_group)
            @php
                $totalCartones3 = $card_group->cardboard_count;
                $cartones_vendidos3 = $card_group->cardboards_vendidos;
                $cartones_obsequio3 = $card_group->cardboards_obsequio;

                $totalCartones_pendientes3 = $totalCartones3 - ($cartones_vendidos3 + $cartones_obsequio3);
            @endphp
            <div class="modal fade" id="modal-datail-group_{{$loop->iteration}}"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detalle del grupo</h4>
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
                                            <input class="form-control form-control-border" type="text" disabled value="{{ $user->name }} {{ $user->lastname }}" id="username">
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
                                                <input class="form-control form-control-border" type="text" disabled value="{{ $user->name }} {{ $user->lastname }}" id="username">
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
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Cartones Asignados', 'Cartones Pendientes por Vender'],
                datasets: [{
                    data: [{{ $totalCartonesAsignados }}, {{ $totalCartonesPendientes }}],
                    backgroundColor: [
                        'rgb(75, 192, 192)',
                        'rgb(255, 99, 132)'
                    ]
                }]
            },

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
