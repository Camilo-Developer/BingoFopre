@extends('layouts.app')
@section('title', 'Noticias Pricipales')
@section('content')
    <!--Migas de pan-->
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
    <!--Contenido- Formulario-->
    <section class="content">
        <div class="container-fluid" >
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">Crear Noticia</button>
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
                                        <th scope="col">Imagen</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cardmains as $cardmain)
                                            <tr class="text-center">
                                                <th scope="row" style="width: 50px;">{{$cardmain->id}}</th>
                                                <td style="width: 100px;"><img width="14px" src="{{asset('storage/' . $cardmain->imagen)}}" alt="{{$cardmain->title}}"></td>
                                                <td>{{$cardmain->title}}</td>
                                                <td style="width: 100px;"><button type="button" data-toggle="modal" data-target="#modal-edit-noticia_{{$loop->iteration}}" class="btn btn-warning">Editar</button></td>
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
                        <h4 class="modal-title">Nueva Noticia</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form action="{{route('admin.cardmains.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                <div class="d-flex justify-content-end">
                                    <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                </div>
                                <div class="form-group">
                                    <label for="title"><span class="text-danger">*</span> Título:</label>
                                    <input type="text" name="title" required class="form-control form-control-border" id="title" placeholder="Título">
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="imagen"><span class="text-danger">*</span> Imagen:</label>
                                            <input type="file" name="imagen" required class="form-control form-control-border" id="imagen">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="mas_info">Más infromación:</label>
                                            <input type="url" name="mas_info" class="form-control form-control-border" id="mas_info" placeholder="Escriba la URL">
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

        @foreach($cardmains as $cardmain)
            <!-- Modal para editar una noticia -->
            <div class="modal fade" id="modal-edit-noticia_{{$loop->iteration}}"  aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Notica</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <form action="{{route('admin.cardmains.update', $cardmain)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                    <div class="d-flex justify-content-end">
                                        <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="title"><span class="text-danger">*</span> Título:</label>
                                        <input type="text" value="{{$cardmain->title}}" name="title" required class="form-control form-control-border" id="title" placeholder="Título">
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="imagen"><span class="text-danger">*</span> Imagen:</label>
                                                <input type="file" value="{{$cardmain->imagen}}" name="imagen"  class="form-control form-control-border" id="imagen">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="mas_info">Más infromación:</label>
                                                <input type="url" value="{{$cardmain->mas_info}}" name="mas_info" class="form-control form-control-border" id="mas_info" placeholder="Escriba la URL">
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
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <div>
                                    <button type="submit" class="btn btn-warning">Editar</button>
                                    <a title="Eliminar" onclick="document.getElementById('eliminarApunte_{{ $loop->iteration }}').submit()" class="btn btn-danger ">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <form action="{{route('admin.cardmains.destroy',$cardmain)}}"  method="POST" id="eliminarApunte_{{ $loop->iteration }}">
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
@endsection