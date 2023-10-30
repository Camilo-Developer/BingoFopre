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

                                @if(Gate::check('users.dashboard.admin.stundents') && Gate::check('users.dashboard.admin.seller'))
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link mb-0" id="tabs-iconpricing-tab-1" data-bs-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="false" tabindex="-1">
                                            Mis Cartones
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link mb-0" id="tabs-iconpricing-tab-2" data-bs-toggle="tab" href="#annual" role="tab" aria-controls="annual" aria-selected="false" tabindex="-1">
                                            Información del Usuario
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link mb-0 active" id="tabs-iconpricing-tab-3" data-bs-toggle="tab" href="#seller" role="tab" aria-controls="seller" aria-selected="true" >
                                            Información Vendedor
                                        </a>
                                    </li>
                                @elseif(Gate::check('users.dashboard.admin.stundents'))

                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link mb-0 active" id="tabs-iconpricing-tab-1" data-bs-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="false" tabindex="-1">
                                            Mis Cartones
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link mb-0" id="tabs-iconpricing-tab-2" data-bs-toggle="tab" href="#annual" role="tab" aria-controls="annual" aria-selected="false" tabindex="-1">
                                            Información del Usuario
                                        </a>
                                    </li>

                                @elseif(Gate::check('users.dashboard.admin.seller'))
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link mb-0 active" id="tabs-iconpricing-tab-3" data-bs-toggle="tab" href="#seller" role="tab" aria-controls="seller" aria-selected="true" >
                                            Información Vendedor
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content tab-space">
                    @if(Gate::check('users.dashboard.admin.stundents') && Gate::check('users.dashboard.admin.seller'))
                        <div class="tab-pane " id="monthly" role="tabpanel" aria-labelledby="#tabs-iconpricing-tab-1">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h5 class="font-weight-bolder mb-3">Mis compras por día vendido + obsequio</h5>
                                    <canvas id="miGrafica"></canvas>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5 class="font-weight-bolder mb-3">Total de mis compras</h5>
                                    <canvas id="miGrafica3"></canvas>
                                </div>
                                <div class="col-12 my-4">
                                    <h5 class="font-weight-bolder ">Cartones Comprados</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr class="text-center">
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Fecha Compra</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($carton_document_users as $carton_document_user)
                                                <tr class="text-center">
                                                    <td>
                                                        {{$carton_document_user->name}}
                                                    </td>
                                                    <td>$ {{number_format(intval($carton_document_user->price))}}</td>
                                                    <td>{{$carton_document_user->state->name}}</td>
                                                    <td>{{$carton_document_user->updated_at->format('d , M Y')}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end my-2">
                                        {{ $carton_document_users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="annual" role="tabpanel" aria-labelledby="#tabs-iconpricing-tab-2">
                            <div class="row">
                                <div class="col-lg-6  mb-3">
                                    <div>
                                        <label>Nombres</label>
                                        <input value="{{auth()->user()->name}}"  class="form-control" placeholder="Nombres"  disabled type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label>Apellidos</label>
                                        <input value="{{auth()->user()->lastname}}"  class="form-control" placeholder="Apellidos" disabled type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label>Número documento</label>
                                        <input value="{{auth()->user()->document_number}}"  class="form-control" placeholder="Número de documento" disabled type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label>Correo eléctronico</label>
                                        <input value="{{auth()->user()->email}}"  class="form-control" placeholder="Correo eléctronico" disabled type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label>Estado</label>
                                        <input value="{{auth()->user()->state->name}}"  class="form-control" placeholder="Correo eléctronico" disabled type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label>Rol</label>
                                        @php
                                            $roles = auth()->user()->roles->pluck('name')->implode(', ');
                                        @endphp
                                        <input value="{{ $roles }}" class="form-control" placeholder="Roles" disabled type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active show" id="seller" role="tabpanel" aria-labelledby="#tabs-iconpricing-tab-3">
                            <div class="row">
                                <div class="col-12">
                                    <div  id="count-stats">
                                        <div class="row">
                                            <div class="col-lg-9 z-index-2 border-radius-xl mx-auto py-3">
                                                <div class="row">
                                                    <div class="col-md-3 position-relative">
                                                        <div class="p-3 text-center">
                                                            <h1 class="text-gradient text-primary"><span id="state1" countto="{{ $totalGruposAsignados }}">{{ $totalGruposAsignados }}</span></h1>
                                                            <h5 class="mt-3">Grupos asignados</h5>
                                                        </div>
                                                        <hr class="vertical dark">
                                                    </div>
                                                    <div class="col-md-3 position-relative">
                                                        <div class="p-3 text-center">
                                                            <h1 class="text-gradient text-primary"> <span id="state4" countto="{{ $totalMontoGrupo }}">{{$totalMontoGrupo }}</span></h1>
                                                            <h5 class="mt-3">Monto total grupos asignados</h5>
                                                        </div>
                                                        <hr class="vertical dark">
                                                    </div>

                                                    <div class="col-md-3 position-relative">
                                                        <div class="p-3 text-center">
                                                            <h1 class="text-gradient text-primary"> <span id="state2" countto="{{ $totalMontoVendido }}">{{$totalMontoVendido }}</span></h1>
                                                            <h5 class="mt-3">Monto total cartones vendidos</h5>
                                                        </div>
                                                        <hr class="vertical dark">
                                                    </div>
                                                    <div class="col-md-3 position-relative">
                                                        <div class="p-3 text-center">
                                                            <h1 class="text-gradient text-primary" id="state3" countto="{{$totalMontoObsequio }}">{{ $totalMontoObsequio}}</h1>
                                                            <h5 class="mt-3">Monto total cartones obsequio</h5>
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

                                <div class="col-12">
                                    <div  id="count-stats">
                                        <div class="row">
                                            <div class="col-lg-9 z-index-2 border-radius-xl mx-auto py-3">
                                                <div class="row">
                                                    <div class="col-md-3 position-relative">
                                                        <div class="p-3 text-center">
                                                            <h1 class="text-gradient text-primary"><span id="state10" countto="{{ $totalCartonesVendidos2 }}">{{ $totalCartonesVendidos2 }}</span></h1>
                                                            <h5 class="mt-3">Total cartones vendidos</h5>
                                                        </div>
                                                        <hr class="vertical dark">
                                                    </div>
                                                    <div class="col-md-3 position-relative">
                                                        <div class="p-3 text-center">
                                                            <h1 class="text-gradient text-primary"> <span id="state40" countto="{{ $totalCartonesObsequios2 }}">{{$totalCartonesObsequios2 }}</span></h1>
                                                            <h5 class="mt-3">Total cartones obsequio</h5>
                                                        </div>
                                                        <hr class="vertical dark">
                                                    </div>

                                                    <div class="col-md-3 position-relative">
                                                        <div class="p-3 text-center">
                                                            <h1 class="text-gradient text-primary"> <span id="state20" countto="{{ $totalMontoVendido2 }}">{{$totalMontoVendido2 }}</span></h1>
                                                            <h5 class="mt-3">Monto total vendidos</h5>
                                                        </div>
                                                        <hr class="vertical dark">
                                                    </div>
                                                    <div class="col-md-3 position-relative">
                                                        <div class="p-3 text-center">
                                                            <h1 class="text-gradient text-primary" id="state30" countto="{{$totalMontoObsequio2 }}">{{ $totalMontoObsequio2}}</h1>
                                                            <h5 class="mt-3">Monto total obsequio</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                <th scope="col">Acción</th>
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
                                                        <a data-bs-toggle="modal" data-bs-target="#modal-datail-group_year_{{$loop->iteration}}" title="Detalle del grupo">
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
                                <div class="col-12 mt-3">
                                    {{--<h5 class="font-weight-bolder ">Historial de cartones vendidos año {{$currentYear}}</h5>--}}

                                </div>
                            </div>
                        </div>

                    @elseif(Gate::check('users.dashboard.admin.stundents'))
                        <div class="tab-pane active show" id="monthly" role="tabpanel" aria-labelledby="#tabs-iconpricing-tab-1">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h5 class="font-weight-bolder mb-3">Mis compras por día vendido + obsequio</h5>
                                    <canvas id="miGrafica"></canvas>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5 class="font-weight-bolder mb-3">Total de mis compras</h5>
                                    <canvas id="miGrafica3"></canvas>
                                </div>
                                <div class="col-12 my-4">
                                    <h5 class="font-weight-bolder ">Cartones Comprados</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr class="text-center">
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Fecha Compra</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($carton_document_users as $carton_document_user)
                                                <tr class="text-center">
                                                    <td>
                                                        {{$carton_document_user->name}}
                                                    </td>
                                                    <td>$ {{number_format(intval($carton_document_user->price))}}</td>
                                                    <td>{{$carton_document_user->state->name}}</td>
                                                    <td>{{$carton_document_user->updated_at->format('d , M Y')}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end my-2">
                                        {{ $carton_document_users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="annual" role="tabpanel" aria-labelledby="#tabs-iconpricing-tab-2">
                            <div class="row">
                                <div class="col-lg-6  mb-3">
                                    <div>
                                        <label>Nombres</label>
                                        <input value="{{auth()->user()->name}}"  class="form-control" placeholder="Nombres"  disabled type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label>Apellidos</label>
                                        <input value="{{auth()->user()->lastname}}"  class="form-control" placeholder="Apellidos" disabled type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label>Número documento</label>
                                        <input value="{{auth()->user()->document_number}}"  class="form-control" placeholder="Número de documento" disabled type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label>Correo eléctronico</label>
                                        <input value="{{auth()->user()->email}}"  class="form-control" placeholder="Correo eléctronico" disabled type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label>Estado</label>
                                        <input value="{{auth()->user()->state->name}}"  class="form-control" placeholder="Correo eléctronico" disabled type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label>Rol</label>
                                        @php
                                            $roles = auth()->user()->roles->pluck('name')->implode(', ');
                                        @endphp
                                        <input value="{{ $roles }}" class="form-control" placeholder="Roles" disabled type="text">
                                    </div>
                                </div>
                            </div>
                        </div>

                    @elseif(Gate::check('users.dashboard.admin.seller'))
                        <div class="tab-pane active show" id="seller" role="tabpanel" aria-labelledby="#tabs-iconpricing-tab-3">
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
                                                                    <a data-bs-toggle="modal" data-bs-target="#modal-datail-group_{{$loop->iteration}}" title="Detalle del grupo">
                                                                        <button  type="button" class="btn btn-success">
                                                                            <i class="fa fa-eye"></i>
                                                                        </button>
                                                                    </a><a data-bs-toggle="modal" data-bs-target="#modal-datail-group_{{$loop->iteration}}" title="Detalle del grupo">
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
                                                <th scope="col">Acción</th>
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
                                                        <a data-bs-toggle="modal" data-bs-target="#modal-datail-group_year_{{$loop->iteration}}" title="Detalle del grupo">
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
                                <div class="col-12 mt-3">
                                    {{--<h5 class="font-weight-bolder ">Historial de cartones vendidos año {{$currentYear}}</h5>--}}

                                </div>
                            </div>
                        </div>

                    @endcan


                </div>
            </div>
    </section>


@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <script>
        var ctx = document.getElementById('miGrafica').getContext('2d');

        // Obtén los datos de montos vendidos por día desde PHP
        var montoPorDiaData = @json($comprasPorDia);

        // Separa las fechas y los montos en dos arreglos
        var fechas = montoPorDiaData.map(function (item) {
            return item.sold_date;
        });
        //console.log(montoPorDiaData);

        var montos = montoPorDiaData.map(function (item) {
            return item.total_cartones;
        });

        var data = {
            labels: fechas,
            datasets: [{
                label: 'Monto total comprado por día cartones ven + obs',
                data: montos,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
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

    <script>
        var ctx = document.getElementById('miGrafica3').getContext('2d');
        var data = {
            labels: ['Car. Comprados', 'Car. Obsequio', 'Tol. Cartones'],
            datasets: [{
                label: 'Totales cartones',
                data: [{{ $carton_document_users_vendidos }}, {{$carton_document_users_obsequio}},{{$carton_document_users_total}}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(49,220,169,0.2)',
                ],
                borderColor: [
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
