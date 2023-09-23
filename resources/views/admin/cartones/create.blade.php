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
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_crear_cartones"> <i class="fa fa-plus"></i> Crear Cartones</button>
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
                                        <th scope="col">Fecha de Creación</th>
                                        <th scope="col">Fecha de Edición</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cardboards as $cardboard)
                                        <tr class="text-center">
                                            <td>{{$cardboard->name}}</td>
                                            <td>$ {{number_format(intval($cardboard->price))}}</td>
                                            <td>{{$cardboard->state->name}}</td>
                                            <td>{{$cardboard->group_id}}</td>
                                            <td>
                                                {{ $cardboard->created_at->format('Y-m-d') }}
                                            </td>
                                            <td>{{$cardboard->updated_at->format('Y-m-d')}}</td>
                                            <td>
                                                <div class="btn btn-group">
                                                    <a href="" class="btn btn-warning"  data-toggle="modal" data-target="#modal_editar_cartones_{{$loop->iteration}}"> <i class="fa fa-edit"></i> </a>
                                                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal_show_cartones_{{$loop->iteration}}" style="margin-left: 5px;"> <i class="fa fa-eye"></i> </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Agregar código para mostrar el botón cuando haya resultados -->
                            @if(!empty($search) && !$cardboards->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.cartones.createForm') }}" class="btn btn-danger">Borrar búsqueda</a>
                                    </div>
                                </div>
                            @endif
                            <!-- Agregar código para mostrar el mensaje cuando no haya resultados -->
                            @if($cardboards->isEmpty())
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
                    {!! $cardboards->links() !!}
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
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{ route('admin.cartones.create') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="start_number">Número de Inicio</label>
                                            <input type="number" id="start_number" name="start_number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="end_number">Número Final</label>
                                            <input type="number" id="end_number" name="end_number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="group_size">Tamaño del Grupo</label>
                                            <input type="number" id="group_size" name="group_size" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="price">Precio</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" id="price" name="price" required class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Crear Cartones y Grupos</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($cardboards as $cardboard)
    <div class="modal fade" id="modal_editar_cartones_{{$loop->iteration}}"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edición de cartón</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{ route('admin.cartones.create') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="start_number">Nombre:</label>
                                            <input type="number" value="{{$cardboard->name}}" id="start_number" name="start_number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="end_number">Precio:</label>
                                            <input type="number" value="{{$cardboard->price}}"  id="end_number" name="end_number" class="form-control" required>
                                        </div>
                                    </div>
                                    <style>
                                        .select2-container .select2-selection--single{
                                            height: 35px!important;
                                        }
                                    </style>
                                    <div class="col-6">
                                        <label for="">Grupos:</label>
                                        <div class="row">
                                            <div class="col-12">
                                                    <select id="groupSelect_{{$loop->iteration}}" class="form-control" style="width: 100%;">
                                                        <option value=""></option> <!-- Agrega una opción en blanco -->
                                                        @foreach($carton_groups as $carton_group)
                                                            <option value="{{$carton_group->id}}" {{ $carton_group->id == $cardboard->group_id ? 'selected' : '' }} {{ old('group_id') == $carton_group->id ? 'selected' : '' }}>{{$carton_group->id}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="state_id">Estado:</label>
                                            <select class="custom-select form-control-border" name="state_id" id="state_id">
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}" {{ $state->id == $cardboard->state_id ? 'selected' : '' }} {{ old('state_id') == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="group_size">Documento de Identidad Comprador</label>
                                    </div>
                                    <div class="col-10">
                                        <div class="form-group">
                                            <input type="number" value="{{$cardboard->document_number}}" id="group_size" name="group_size" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-success">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Editar Cartón</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_show_cartones_{{$loop->iteration}}"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalle del cartón</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <label>Datos del cartón</label>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="n_carton">Número del Cartón:</label>
                                        <input disabled value="{{$cardboard->name}}" type="number" id="n_carton" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price_carton">Precio del Cartón:</label>
                                        <input disabled value="{{$cardboard->price}}" type="number" id="price_carton" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price_carton">Grupo:</label>
                                        <input disabled value="{{$cardboard->group_id}}" type="number" id="price_carton" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="n_carton">Nombre del Vendedor:</label>
                                        <input disabled value="{{ optional($cardboard->cartongroup)->user->name ?? 'N/A' }}" type="text" id="name_vendedor" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label>Datos del Comprador</label>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="price_carton">Documento de Identidad:</label>
                                        <input disabled value="{{$cardboard->document_number}}" type="number" id="price_carton" class="form-control">
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
@endsection
@section('js')
    @foreach($cardboards as $cardboard)
        <script>
        $(document).ready(function() {
            // Inicializar el select2 con opciones mínimas
            $('#groupSelect_{{$loop->iteration}}').select2({
                minimumInputLength: 1, // Comenzar la búsqueda después de ingresar al menos 1 carácter
                placeholder: "Buscar Grupo..."
            });
        });
    </script>
    @endforeach
@endsection
