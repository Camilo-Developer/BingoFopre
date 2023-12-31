@extends('layouts.app')
@section('title', 'Noticias Pricipales')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Noticias Generales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Noticias Generales</li>
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
                                    @can('admin.cardmains.create')
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fa fa-check"></i> Crear Noticia</button>
                                    @endcan
                                </div>
                                <div class="col-12 col-md-9 d-flex justify-content-end">
                                    <form action="{{ route('admin.cardmains.index') }}" method="GET">
                                        <div class="input-group input-group-sm buq-menu" >
                                            <input value="{{$search}}"   type="search" name="search" class="form-control float-right" placeholder="Buscar Noticia">
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
                                        <th scope="col">#</th>
                                        <th scope="col">Imagen</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Creación</th>
                                        <th scope="col">Edición</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cardmains as $cardmain)
                                            <tr class="text-center">
                                                <th scope="row" style="width: 50px;">{{$cardmain->id}}</th>
                                                <td style="width: 100px;"><img width="14px" src="{{asset('storage/' . $cardmain->imagen)}}" alt="{{$cardmain->title}}"></td>
                                                <td>{{$cardmain->title}}</td>
                                                <td>{{$cardmain->state->name}}</td>
                                                <td>{{ $cardmain->created_at->format('Y-m-d')  }}</td>
                                                <td>{{$cardmain->updated_at->format('Y-m-d')}}</td>
                                                <td >
                                                    <div class="btn btn-group">
                                                        @can('admin.cardmains.edit')
                                                        <button type="button" data-toggle="modal" data-target="#modal-edit-noticia_{{$loop->iteration}}" class="btn btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        @endcan
                                                        @can('admin.cardmains.destroy')
                                                        <a style="margin-left: 5px" title="Eliminar" onclick="document.getElementById('eliminarApunte_{{ $loop->iteration }}').submit()" class="btn btn-danger ">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                            @can('admin.cardmains.destroy')
                                                <form action="{{route('admin.cardmains.destroy',$cardmain)}}"  method="POST" id="eliminarApunte_{{ $loop->iteration }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endcan
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if(!empty($search) && !$cardmains->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.cardmains.index') }}" class="btn btn-danger"> <i class="fa fa-trash"></i> Borrar búsqueda</a>
                                    </div>
                                </div>
                            @endif
                            @if($cardmains->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center mt-4">No hay resultados para tu búsqueda.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.cardmains.index') }}" class="btn btn-danger"> <i class="fa fa-trash"></i> Borrar búsqueda</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{$cardmains->links()}}
                </div>
            </div>
        </div>
        @can('admin.cardmains.create')
        <div class="modal fade" id="modal-default"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nueva Noticia</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{route('admin.cardmains.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                        <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-end">
                                                <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                            </div>
                                        </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-center">
                                                    <img style="width: 100px; height: 100px" src="{{asset('img/bingo.jpg')}}" id="imagenSeleccionada" class="card-img-top img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="imagen"><span class="text-danger">*</span> Imagen:</label>
                                                    <input type="file" name="imagen" required class="form-control form-control-border" id="imagen">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="title"><span class="text-danger">*</span> Título:</label>
                                                    <input type="text" name="title" required class="form-control form-control-border" id="title" placeholder="Título">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="mas_info">Más información:</label>
                                                    <input type="url" name="mas_info" class="form-control form-control-border" id="mas_info" placeholder="Escriba la URL">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="state_id"><span class="text-danger">*</span> Estado:</label>
                                                    <select class="custom-select form-control-border" name="state_id" id="state_id">
                                                        <option selected disabled>-- Seleccionar --</option>
                                                        @foreach($states as $state)
                                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description"><span class="text-danger">*</span> Descripción</label>
                                            <textarea id="compose-textarea" name="description" required class="form-control" style="height: 500px!important;">
                                            </textarea>
                                        </div>
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
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        @endcan
        @can('admin.cardmains.edit')
        @foreach($cardmains as $cardmain)
            <!-- Modal para editar una noticia -->
            <div class="modal fade" id="modal-edit-noticia_{{$loop->iteration}}"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-edit"></i> Editar Notica</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{route('admin.cardmains.update', $cardmain)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-end">
                                                        <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-center">
                                                        <img style="width: 100px; height: 100px;" src="{{asset('storage/' . $cardmain->imagen)}}" id="imagenSeleccionadas_{{$loop->iteration}}" class="card-img-top img-fluid">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="images_{{$loop->iteration}}"><span class="text-danger">*</span> Imagen:</label>
                                                        <input type="file" value="{{$cardmain->imagen}}" name="imagen"  class="form-control form-control-border" id="images_{{$loop->iteration}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="title"><span class="text-danger">*</span> Título:</label>
                                                        <input type="text" value="{{$cardmain->title}}" name="title" required class="form-control form-control-border" id="title" placeholder="Título">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="mas_info">Más información:</label>
                                                        <input type="url" value="{{$cardmain->mas_info}}" name="mas_info" class="form-control form-control-border" id="mas_info" placeholder="Escriba la URL">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="state_id">Estado:</label>
                                                        <select class="custom-select form-control-border" name="state_id" id="state_id">
                                                            @foreach($states as $state)
                                                                <option value="{{$state->id}}" {{ $state->id == $cardmain->state_id ? 'selected' : '' }} {{ old('state_id') == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="description"><span class="text-danger">*</span> Descripción</label>
                                                <textarea id="editNovedad_{{$loop->iteration}}" name="description" required class="form-control" style="height: 500px!important;">
                                            {!! $cardmain->description !!}
                                        </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                                <div>
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i>Editar</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        @endcan
    </section>
    @endsection
@section('js')
    <script>
        $(function () {
            //Add text editor
            $('#compose-textarea').summernote(
                {
                    tabsize: 2,
                    height: 200
                }
            );
        });
        @foreach($cardmains as $cardmain)
            $(function () {
                //Add text editor
                $('#editNovedad_{{$loop->iteration}}').summernote(
                    {
                        tabsize: 2,
                        height: 200
                    }
                );
            });
        @endforeach
    </script>
    <script>
        $(document).ready(function (e) {
            $('#imagen').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

    </script>
    <script>
        @foreach($cardmains as $cardmain)
        $(document).ready(function (e) {
            $('#images_{{$loop->iteration}}').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionadas_{{$loop->iteration}}').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
        @endforeach
    </script>
@endsection
