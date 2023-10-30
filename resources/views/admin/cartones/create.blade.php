@extends('layouts.app')
@section('title', 'Listadado Cartones')
@section('content')
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
    <section class="content">
        <div class="container-fluid" >
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_crear_cartones"> <i class="fa fa-plus"></i> Crear Cartones</button>
                                    @can('admin.cardboard.generadormasivoQR')
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_crear_qr"> <i class="fa fa-qrcode"></i> Crear QR</button>
                                    @endcan
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_cargue_masivo"> <i class="fa fa-file-excel"></i> Cargue masivo</button>

                                </div>
                                <div class="col-12 col-md-6 d-flex justify-content-end">
                                    <form action="{{ route('admin.cartones.createForm') }}" method="GET">
                                        <div class="input-group input-group-sm buq-menu" >
                                            <input value="{{$search}}"   type="search" name="search" class="form-control float-right" placeholder="Buscar cartón">
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
                                        <th scope="col">Precio</th>
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
                                                    @can('admin.cartones.update')
                                                    <a href="" class="btn btn-warning"  data-toggle="modal" data-target="#modal_editar_cartones_{{$loop->iteration}}"> <i class="fa fa-edit"></i> </a>
                                                    @endcan
                                                    @can('admin.cartones.show')
                                                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal_show_cartones_{{$loop->iteration}}" style="margin-left: 5px;"> <i class="fa fa-eye"></i> </a>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if(!empty($search) && !$cardboards->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.cartones.createForm') }}" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar búsqueda</a>
                                    </div>
                                </div>
                            @endif
                            @if($cardboards->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center mt-4">No hay resultados para tu búsqueda.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.cartones.createForm') }}" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar búsqueda</a>
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
                    <h4 class="modal-title"><i class="fa fa-check-circle"></i> Creación de Grupos y Cartones masivos</h4>
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
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Crear Cartones y Grupos</button>
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
    @can('admin.cardboard.generadormasivoQR')
        <div class="modal fade" id="modal_crear_qr"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-qrcode"></i> Creación de QR masivos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{ route('admin.cardboard.generadormasivoQR') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inicio">Número de Inicio</label>
                                            <input type="number" id="inicio" name="inicio" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="final">Número de Final</label>
                                            <input type="number" id="final" name="final" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-qrcode"></i> Generar QRs</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan


    <div class="modal fade" id="modal_cargue_masivo"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-file-excel"></i> Cargue masivo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="container-fluid">
                                        <form method="POST" action="{{ route('admin.importar.cartones') }}"  enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4>Instrucciones para el cargue masivo de cartones</h4>
                                                    <h5><b>Paso 1</b></h5>
                                                    <p>
                                                        Descague la plantilla de excel en la cual podra poner los datos necesarios para hacer el cargue masivo.
                                                        <br>
                                                        Recuerde no eliminar los titulos que encontra en esta plantilla.
                                                        <a href="{{asset('archivos/Plantilla_Cargue_Masivo.xlsx')}}" download="">Descargar la Plantilla.</a>
                                                        <br>
                                                        Los campos requeridos son:
                                                        <br>
                                                    </p>
                                                    <div class="mx-5">
                                                        <ol>
                                                            <li>
                                                                <b>Nombre del cartón.</b>
                                                            </li>
                                                            <li>
                                                                <b>Precio del cartón.</b>
                                                            </li>
                                                            <li>
                                                                <b>Estado del cartón.</b>
                                                            </li>
                                                        </ol>
                                                    </div>
                                                    <p>Los demás campos son opcionales.</p>
                                                    <h5><b>Paso 2</b></h5>
                                                    <p>
                                                        El campo <b>Nombre del cartón</b>
                                                         debe ser númerico y único.
                                                        <br>
                                                        <b>Ejemplo:</b> 15635
                                                    </p>
                                                    <h5><b>Paso 3</b></h5>
                                                    <p>
                                                        El campo <b>Precio</b> no debe llevar ni " , . $ " solo el valor correspondiente debe ser númerico.
                                                    </p>
                                                    <h5><b>Paso 4</b></h5>
                                                    <p>
                                                        El campo <b>Fecha de Venta</b> debe tener el siguiente formato: 18/05/2023
                                                    </p>
                                                    <h5><b>Paso 5</b></h5>
                                                    <p>
                                                        El campo <b>Estado del cartón</b> debe tener el siguiente formato:
                                                        <br>
                                                        <b>Estados Disponibles</b>
                                                    </p>
                                                    <div class="mx-5">
                                                        <ol>
                                                            <li>
                                                                <b>Vendido:</b> 5
                                                            </li>
                                                            <li>
                                                                <b>Obsequio.</b> 6
                                                            </li>
                                                        </ol>
                                                    </div>
                                                    <p>Recuerde poner el número que esta a cada lado del estado ya que de no ser asi no podra llevar acabo el cargue masivo.</p>
                                                    <h5><b>Opcional</b></h5>
                                                    <p>
                                                        Si desea descargar un ejemplo de como se veria la plantilla completamente llena.
                                                        <br>
                                                        <a href="{{asset('archivos/Plantilla_ejemplo_de_llenado.xlsx')}}" download="">Descargar plantilla llena.</a>
                                                    </p>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="file">Seleccione el archivo:</label>
                                                        <input type="file" id="file" name="file"  accept=".xlsx, .xls" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-file-excel"></i>  Cargar Cartones Masivos</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @foreach($cardboards as $cardboard)
        @can('admin.cartones.update')
            <div class="modal fade" id="modal_editar_cartones_{{$loop->iteration}}"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Edición de cartón</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">

                            <form id="editar_{{ $loop->iteration }}" method="POST" action="{{ route('admin.cartones.update',$cardboard) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Nombre:</label>
                                            <input type="number" value="{{$cardboard->name}}" id="name" name="name" class="form-control" required>
                                        </div>
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="price">Precio:</label>
                                            <input type="number" value="{{$cardboard->price}}"  id="price" name="price" class="form-control" required>
                                        </div>
                                        @error('price')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <style>
                                        .select2-container .select2-selection--single{
                                            height: 35px!important;
                                        }
                                    </style>
                                    <div class="col-6">
                                        <label>Grupos:</label>
                                        <div class="row">
                                            <div class="col-12">
                                                    <select id="groupSelect_{{$loop->iteration}}" name="group_id" class="form-control" style="width: 100%;">
                                                        <option value=""></option> <!-- Agrega una opción en blanco -->
                                                        @foreach($carton_groups as $carton_group)
                                                            <option value="{{$carton_group->id}}" {{ $carton_group->id == $cardboard->group_id ? 'selected' : '' }} {{ old('group_id') == $carton_group->id ? 'selected' : '' }}>{{$carton_group->id}}</option>
                                                        @endforeach
                                                    </select>

                                            </div>
                                        </div>
                                        @error('group_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
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
                                        @error('state_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name_vendedor">Correo del usuario asignado grupo:</label>
                                            <input disabled value="{{ optional($cardboard->cartongroup)->user->email ?? 'N/A' }}" type="text" id="name_vendedor" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <label for="userSelect">Correo Vendedor del cartón:</label>
                                        <div class="form-group">
                                            <select id="userSelect_{{$loop->iteration}}" name="user_id" class="form-control" style="width: 100%">
                                                <option value=""></option>
                                                @foreach ($users as $user)
                                                    <option value="{{$user->id}}" {{ $user->id == $cardboard->user_id ? 'selected' : '' }} {{ old('user_id') == $user->id ? 'selected' : '' }}>{{$user->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('user_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="document_number">Datos del comprador</label>
                                    </div>

                                    <input  value="{{$cardboard->Categoria_Principal__c}}" name="Categoria_Principal__c"  type="hidden" >
                                    <input  value="{{$cardboard->Categoria__c}}"  name="Categoria__c"   type="hidden" >
                                    <input  value="{{$cardboard->Categoria_Administrativo__c}}"  name="Categoria_Administrativo__c"  type="hidden" >
                                    <input value="{{$cardboard->FirstName}}" type="hidden"  name="FirstName" >
                                    <input value="{{$cardboard->LastName}}" type="hidden"  name="LastName" >
                                    <input  value="{{$cardboard->generoEmail__c}}"  name="generoEmail__c"  type="hidden" >
                                    <input  value="{{$cardboard->Tipo_identificaci_n__c}}"  name="Tipo_identificaci_n__c"  type="hidden" >
                                    <input  value="{{$cardboard->document_number}}"  name="document_number"  type="hidden" >
                                    <input  value="{{$cardboard->Tel_fono_celular_1__c}}" name="Tel_fono_celular_1__c"   type="hidden" >
                                    <input  value="{{$cardboard->Email}}" name="Email"   type="hidden" >
                                    <input  type="hidden" name="sold_date" value="{{$cardboard->sold_date ?? $date_sold_user_requireds}}">



                                </div>
                            </form>

                            <form id="search-form_{{ $loop->iteration }}">
                                @csrf
                                <label for="search2">Documento o correo del comprador:</label>
                                <div class="row">
                                    <div class="col-8 col-lg-10">
                                        <input class="form-control" type="text" name="search2"  id="search2" required>
                                    </div>
                                    <div class="col-4 col-lg-2">
                                        <button type="button" id="search-button_{{ $loop->iteration }}" class="btn btn-success">Buscar</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12">
                                    <div id="loading-alert_{{ $loop->iteration }}" class="alert alert-info" style="display: none;">
                                        Buscando usuario comprador...
                                    </div>
                                    <div id="not-found-alert_{{ $loop->iteration }}" class="alert alert-danger" style="display: none;">
                                       No se encontró al usuario. Por favor, vuelve a intentarlo.
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Nombre:</label>
                                                <input disabled value="{{$cardboard->FirstName}}" type="text" name="FirstName" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Apellido:</label>
                                                <input disabled value="{{$cardboard->LastName}}" type="text"  name="LastName" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Tipo Documento:</label>
                                                <input disabled value="{{$cardboard->Tipo_identificaci_n__c}}" type="text" name="Tipo_identificaci_n__c" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Número Documento:</label>
                                                <input disabled value="{{$cardboard->document_number}}" type="text" name="document_number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Categoría principal:</label>
                                                <input disabled value="{{$cardboard->Categoria_Principal__c}}" type="text" name="Categoria_Principal__c" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Categoría C:</label>
                                                <input disabled value="{{$cardboard->Categoria__c}}" type="text" name="Categoria__c" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Categoría Administrativa C:</label>
                                                <input disabled value="{{$cardboard->Categoria_Administrativo__c}}" type="text" name="Categoria_Administrativo__c" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Correo:</label>
                                                <input disabled value="{{$cardboard->Email}}" type="text" name="Email"  class="form-control">
                                            </div>
                                            @error('Email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Género:</label>
                                                <input disabled value="{{$cardboard->generoEmail__c}}" type="text" name="generoEmail__c" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Teléfono:</label>
                                                <input disabled value="{{$cardboard->Tel_fono_celular_1__c}}" type="text" name="Tel_fono_celular_1__c" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="sold_date">Fecha vendido:</label>
                                                <input disabled value="{{$cardboard->sold_date ?? $date_sold_user_requireds}}" type="text" id="sold_date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <a onclick="document.getElementById('editar_{{ $loop->iteration }}').submit()" class="btn btn-warning"> <i class="fa fa-edit"></i> Editar Cartón</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endcan
        @can('admin.cartones.show')
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
                                                <label for="price_carton">Estado:</label>
                                                <input disabled value="{{$cardboard->state->name}}" type="text" id="price_carton" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="n_carton">Correo del usuario asignado grupo:</label>
                                                <input disabled value="{{ optional($cardboard->cartongroup)->user->name ?? 'N/A' }}" type="text" id="name_vendedor" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="n_carton">Correo Vendedor del cartón:</label>
                                                <input disabled value="{{$cardboard->user->name ?? 'N/A'}}" type="text" id="name_vendedor" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label>Datos del Comprador</label>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Nombre:</label>
                                                        <input disabled value="{{$cardboard->FirstName}}" type="text" name="FirstName" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Apellido:</label>
                                                        <input disabled value="{{$cardboard->LastName}}" type="text"  name="LastName" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Tipo Documento:</label>
                                                        <input disabled value="{{$cardboard->Tipo_identificaci_n__c}}" type="text" name="Tipo_identificaci_n__c" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Número Documento:</label>
                                                        <input disabled value="{{$cardboard->document_number}}" type="text" name="document_number" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Categoría principal:</label>
                                                        <input disabled value="{{$cardboard->Categoria_Principal__c}}" type="text" name="Categoria_Principal__c" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Categoría C:</label>
                                                        <input disabled value="{{$cardboard->Categoria__c}}" type="text" name="Categoria__c" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Categoría Administrativa C:</label>
                                                        <input disabled value="{{$cardboard->Categoria_Administrativo__c}}" type="text" name="Categoria_Administrativo__c" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Correo:</label>
                                                        <input disabled value="{{$cardboard->Email}}" type="text" name="Email"  class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Género:</label>
                                                        <input disabled value="{{$cardboard->generoEmail__c}}" type="text" name="generoEmail__c" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Teléfono:</label>
                                                        <input disabled value="{{$cardboard->Tel_fono_celular_1__c}}" type="text" name="Tel_fono_celular_1__c" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="sold_date">Fecha vendido:</label>
                                                        <input disabled value="{{$cardboard->sold_date}}" type="text" id="sold_date" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

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
        <script>
            $(document).ready(function() {
                function performAjaxRequest() {

                    // Oculta las alertas existentes
                    $("#loading-alert_{{$loop->iteration}}").hide();
                    $("#not-found-alert_{{$loop->iteration}}").hide();

                    // Muestra la alerta de "Buscando usuario comprador"
                    $("#loading-alert_{{$loop->iteration}}").show();

                    $.ajax({
                        url: "{{ route('user.cart.prueba') }}",
                        method: "GET",
                        data: $("#search-form_{{$loop->iteration}}").serialize(),
                        success: function(response) {
                            try {
                                const userData = JSON.parse(response);

                                // Rellenar los campos del formulario con los datos de Salesforce
                                $("input[name='Categoria_Principal__c']").val(userData.Categoria_Principal__c);
                                $("input[name='Categoria__c']").val(userData.Categoria__c);
                                $("input[name='Categoria_Administrativo__c']").val(userData.Categoria_Administrativo__c);
                                $("input[name='FirstName']").val(userData.FirstName);
                                $("input[name='LastName']").val(userData.LastName);
                                $("input[name='Email']").val(userData.Email);
                                $("input[name='generoEmail__c']").val(userData.generoEmail__c);
                                $("input[name='Tipo_identificaci_n__c']").val(userData.Tipo_identificaci_n__c);
                                $("input[name='Tel_fono_celular_1__c']").val(userData.Tel_fono_celular_1__c);
                                $("input[name='document_number']").val(userData.N_mero_de_Identificaci_n__c);

                                // Oculta la alerta una vez que se encuentre el usuario
                                $("#loading-alert_{{$loop->iteration}}").hide();
                            }catch (error) {
                                // Oculta la alerta de "Buscando usuario comprador"
                                $("#loading-alert_{{$loop->iteration}}").hide();
                                // Muestra la alerta de "Usuario no encontrado"
                                $("#not-found-alert_{{$loop->iteration}}").show();
                            }
                        },
                        error: function(xhr, textStatus, error) {
                            // Manejar errores de la solicitud AJAX aquí si es necesario
                            console.error("Error en la solicitud AJAX:", error);

                            // Oculta la alerta de "Buscando usuario comprador"
                            $("#loading-alert_{{$loop->iteration}}").hide();
                        }
                    });
                }

                $("#search-button_{{$loop->iteration}}").on("click", function() {
                    performAjaxRequest();
                });

                $("#search-form_{{$loop->iteration}}").submit(function(e) {
                    e.preventDefault();
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#userSelect_{{$loop->iteration}}').select2({
                    minimumInputLength: 1,
                    placeholder: "Buscar usuario..."
                });
            });
        </script>

    @endforeach


@endsection
