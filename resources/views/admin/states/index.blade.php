@extends('layouts.app')
@section('title', 'Estados')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Estados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Estados</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--Contenido- Formulario-->
    <section class="content">
        <div class="container-fluid" >
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">Crear Estado</button>
                                </div>
                                <div class="col-12 col-md-9 d-flex justify-content-end">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($states as $state)
                                        <tr class="text-center">
                                            <th scope="row" style="width: 50px;">{{$state->id}}</th>
                                            <td>{{$state->name}}</td>
                                            <td style="width: 100px;"><button type="button" data-toggle="modal" data-target="#modal-edit-estado_{{$loop->iteration}}" class="btn btn-warning">Editar</button></td>
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
        <!-- Modal para crear una noticia -->
        <div class="modal fade" id="modal-default"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nueva Estado</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{route('admin.states.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                <div class="d-flex justify-content-end">
                                    <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                </div>
                                <div class="form-group">
                                    <label for="title"><span class="text-danger">*</span> Nombre:</label>
                                    <input type="text" name="name" required class="form-control form-control-border" id="title" placeholder="Título">
                                </div>
                                <div class="form-group">
                                    <label><span class="text-danger mt-1">* </span> Tipo de estado</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input id="activo" class="form-check-input" type="radio" value="1" name="check" >
                                                <label for="activo" class="form-check-label" >Activo</label>
                                            </div>
                                            <div class="form-check">
                                                <input id="no_activo" class="form-check-input" type="radio" value="2" name="check" >
                                                <label for="no_activo" class="form-check-label">No activo</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input id="circulacion" class="form-check-input" type="radio" value="3" name="check" >
                                                <label for="circulacion" class="form-check-label">Circulación</label>
                                            </div>
                                            <div class="form-check">
                                                <input id="anulado" class="form-check-input" type="radio" value="4" name="check" >
                                                <label for="anulado" class="form-check-label">Anulado</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input id="vendido" class="form-check-input" type="radio" value="5" name="check" >
                                                <label for="vendido" class="form-check-label">Vendido</label>
                                            </div>
                                            <div class="form-check">
                                                <input id="obsequio" class="form-check-input" type="radio" value="6" name="check" >
                                                <label for="obsequio" class="form-check-label">Obsequio</label>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        @foreach($states as $state)
            <!-- Modal para editar una noticia -->
            <div class="modal fade" id="modal-edit-estado_{{$loop->iteration}}"  aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Estado</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{route('admin.states.update',$state)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                    <div class="d-flex justify-content-end">
                                        <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="title"><span class="text-danger">*</span> Nombre:</label>
                                        <input type="text" name="name" value="{{$state->name}}" required class="form-control form-control-border" id="title" placeholder="Título">
                                    </div>
                                    <div class="form-group">
                                        <label><span class="text-danger mt-1">* </span> Tipo de estado</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input id="activo" class="form-check-input" type="radio" value="1" name="check" @if($state->check == 1) checked @endif>
                                                    <label for="activo" class="form-check-label" >Activo</label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="no_activo" class="form-check-input" type="radio" value="2" name="check" @if($state->check == 2) checked @endif>
                                                    <label for="no_activo" class="form-check-label">No activo</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input id="circulacion" class="form-check-input" type="radio" value="3" name="check" @if($state->check == 3) checked @endif>
                                                    <label for="circulacion" class="form-check-label">Circulación</label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="anulado" class="form-check-input" type="radio" value="4" name="check" @if($state->check == 4) checked @endif>
                                                    <label for="anulado" class="form-check-label">Anulado</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input id="vendido" class="form-check-input" type="radio" value="5" name="check" @if($state->check == 5) checked @endif>
                                                    <label for="vendido" class="form-check-label">Vendido</label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="obsequio" class="form-check-input" type="radio" value="6" name="check" @if($state->check == 6) checked @endif>
                                                    <label for="obsequio" class="form-check-label">Obsequio</label>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <div>
                                    <button type="submit" class="btn btn-warning">Editar</button>
                                    <a title="Eliminar" onclick="document.getElementById('eliminarEstado_{{ $loop->iteration }}').submit()" class="btn btn-danger ">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <form action="{{route('admin.states.destroy',$state)}}"  method="POST" id="eliminarEstado_{{ $loop->iteration }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        @endforeach
    </section>
@endsection
