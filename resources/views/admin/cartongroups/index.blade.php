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
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_crear_carton_group"> <i class="fa fa-plus"></i> Crear Grupo</button>
                                </div>
                                <div class="col-12 col-md-9 d-flex justify-content-end">
                                    <form action="{{ route('admin.cartongroups.index') }}" method="GET">
                                        <div class="input-group input-group-sm buq-menu" >
                                            <input value="{{$search}}"   type="search" name="search" class="form-control float-right" placeholder="Buscar Grupo">
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
                                                <th scope="col">Grupo</th>
                                                <th scope="col">Responsable</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($cartongroups as $cartongroup)
                                                <tr class="text-center">
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
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if(!empty($search) && !$cartongroups->isEmpty())
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ route('admin.cartongroups.index') }}" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar búsqueda</a>
                                            </div>
                                        </div>
                                    @endif
                                    @if($cartongroups->isEmpty())
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="text-center mt-4">No hay resultados para tu búsqueda.</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ route('admin.cartongroups.index') }}" class="btn btn-danger"> <i class="fa fa-trash"></i> Borrar búsqueda</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{$cartongroups->links()}}
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal_crear_carton_group"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> <i class="fa fa-user"></i> Nuevo Grupo de Cartones</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{route('admin.cartongroups.store')}}" method="post">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                            <div class="d-flex justify-content-end">
                                <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="n_group">Numero del grupo:</label>
                                        <input type="text" value="{{$numeroSiguienteGrupo}}" disabled class="form-control form-control-border" id="n_group">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="userSelect"><span class="text-danger mt-1">* </span> Correo del Usuario:</label>
                                    <div class="form-group">
                                        <select id="userSelect" name="user_id" class="form-control" style="width: 100%">
                                            <option value=""></option>
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->email}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="state_id"><span class="text-danger mt-1">* </span> Estado del grupo:</label>
                                        <select class="custom-select form-control-border" name="state_id" id="state_id">
                                            <option value="">--Seleccionar Estado--</option>
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('state_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#userSelect').select2({
                minimumInputLength: 1,
                placeholder: "Buscar usuario..."
            });
        });
    </script>
@endsection
