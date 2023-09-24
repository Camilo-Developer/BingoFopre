@extends('layouts.app')
@section('title', 'Listado de Grupos')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de Grupos de Cartones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Lista de Grupos de Cartones</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid" >
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_crear_user"> <i class="fa fa-plus"></i> Crear Grupo</button>
                                </div>
                                <div class="col-12 col-md-9 d-flex justify-content-end">
                                    <form action="{{ route('admin.users.index') }}" method="GET">
                                        <div class="input-group input-group-sm buq-menu" >
                                            <input value="{{--$search--}}"   type="search" name="search" class="form-control float-right" placeholder="Buscar Grupo">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr class="text-center">
                                                <th scope="col">#</th>
                                                <th scope="col">Grupo</th>
                                                <th scope="col">Responsable</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $groupN = 1;
                                            @endphp
                                            @foreach($cartongroups as $cartongroup)
                                                <tr class="text-center">
                                                    <td>{{$groupN}}</td>
                                                    <td>{{$cartongroup->id}}</td>
                                                    <td>{{$cartongroup->user->name ?? 'No Asignado'}}</td>
                                                    <td>{{$cartongroup->state->name}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="" class="btn btn-success">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $groupN++;
                                                @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{$cartongroups->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
