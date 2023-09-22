@extends('layouts.app') <!-- Asegúrate de que esta línea coincida con tu diseño de plantilla -->
@section('title', 'Listadado Cartones')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listado de Cartones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Listado de Cartones</li>
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
                        <div class="col-12">
                            <label>Espacio para los Filtros</label>

                        </div>
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_crear_cartones">Crear Cartones</button>
                                </div>
                                <div class="col-12 col-md-9 d-flex justify-content-end">
                                    <form action="{{ route('admin.cartones.createForm') }}" method="GET">
                                        <div class="input-group input-group-sm buq-menu" >
                                            <input value="{{$search}}"   type="search" name="search" class="form-control float-right" placeholder="Buscar carton">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <th scope="col">Nombre</th>
                                        <th scope="col">precio</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Grupo</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cartones as $cardboard)
                                        <tr>
                                            <td>{{$cardboard->name}}</td>
                                            <td>$ {{number_format(intval($cardboard->price))}}</td>
                                            <td>{{$cardboard->state->name}}</td>
                                            <td>{{$cardboard->group_id}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Agregar código para mostrar el botón cuando haya resultados -->
                            @if(!empty($search) && !$cartones->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.cartones.createForm') }}" class="btn btn-danger">Borrar búsqueda</a>
                                    </div>
                                </div>
                            @endif
                            <!-- Agregar código para mostrar el mensaje cuando no haya resultados -->
                            @if($cartones->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center mt-4">No hay resultados para tu búsqueda.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.cartones.createForm') }}" class="btn btn-danger">Borrar búsqueda</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {!! $cartones->links() !!}
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal_crear_cartones"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Creación de cartones masivos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.cartones.create') }}">
                    @csrf

                    <div class="form-group">
                        <label for="start_number">Número de Inicio</label>
                        <input type="number" id="start_number" name="start_number" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="end_number">Número Final</label>
                        <input type="number" id="end_number" name="end_number" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="group_size">Tamaño del Grupo</label>
                        <input type="number" id="group_size" name="group_size" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Precio</label>
                        <input type="number" id="price" name="price" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Crear Cartones y Grupos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
