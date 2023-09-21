@extends('layouts.app')
@section('title', 'Patrocinadores')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Patrocinadores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Patrocinadores</li>
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
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-new-patrocinio">Crear Patrocinio</button>
                                </div>
                                <div class="col-12 col-md-9 d-flex justify-content-end">
                                    <form action="{{ route('admin.sponsors.index') }}" method="GET">
                                        <div class="input-group input-group-sm buq-menu" >
                                            <input value="{{$search}}"   type="search" name="search" class="form-control float-right" placeholder="Buscar Patrocinador">
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
                                        <th scope="col">Accion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sponsors as $sponsor)
                                        <tr class="text-center">
                                            <th scope="row" style="width: 50px;">{{$sponsor->id}}</th>
                                            <td style="width: 100px;"><img width="14px" src="{{asset('storage/' . $sponsor->logo)}}" alt="{{$sponsor->name}}"></td>
                                            <td>{{$sponsor->name}}</td>
                                            <td>{{$sponsor->state->name}}</td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#modal-edit-noticia_{{$loop->iteration}}" class="btn btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <a title="Eliminar" onclick="document.getElementById('eliminarApunte_{{ $loop->iteration }}').submit()" class="btn btn-danger ">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                                </td>
                                        </tr>
                                        <form action="{{route('admin.sponsors.destroy',$sponsor)}}"  method="POST" id="eliminarApunte_{{ $loop->iteration }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Agregar código para mostrar el botón cuando haya resultados -->
                            @if(!empty($search) && !$sponsors->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.sponsors.index') }}" class="btn btn-danger">Borrar búsqueda</a>
                                    </div>
                                </div>
                            @endif
                            <!-- Agregar código para mostrar el mensaje cuando no haya resultados -->
                            @if($sponsors->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center mt-4">No hay resultados para tu búsqueda.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.sponsors.index') }}" class="btn btn-danger">Borrar búsqueda</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para crear un Patrocinador  -->
        <div class="modal fade" id="modal-new-patrocinio"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nuevo Patrocinio</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{route('admin.sponsors.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{asset('img/bingo.jpg')}}" id="imagenSeleccionada" class="card-img-top img-fluid" width="17px" height="27px">
                                </div>
                                <div class="col-9">
                                    <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="logo"><span class="text-danger">*</span> Logo:</label>
                                                    <input type="file" name="logo" required class="form-control form-control-border" id="logo">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nombre:</label>
                                                    <input type="text" required name="name" class="form-control form-control-border" id="name" placeholder="Escriba el nombre">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="state_id">Estado:</label>
                                                    <select class="custom-select form-control-border" name="state_id" id="state_id">
                                                        @foreach($states as $state)
                                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
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
            </div>
        </div>
 <!-- Modal para editar un Patrocinador  -->

        @foreach($sponsors as $sponsor)
            <div class="modal fade" id="modal-edit-noticia_{{$loop->iteration}}"  aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Patrocinio</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{route('admin.sponsors.update', $sponsor)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="{{asset('storage/' . $sponsor->logo)}}" id="imagenSeleccionadas_{{$loop->iteration}}" class="card-img-top img-fluid" width="17px" height="27px">
                                    </div>

                                    <div class="col-9">

                                        <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                            <div class="d-flex justify-content-end">
                                                <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="name"><span class="text-danger">*</span> Nombre:</label>
                                                <input type="text" value="{{$sponsor->name}}" name="name" required class="form-control form-control-border" id="name" placeholder="Nombre">
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="logos_{{$loop->iteration}}"><span class="text-danger">*</span> Logo:</label>
                                                        <input type="file" value="{{$sponsor->logo}}" name="logo"  class="form-control form-control-border" id="logos_{{$loop->iteration}}">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="state_id">Estado:</label>
                                                        <select class="custom-select form-control-border" name="state_id" id="state_id">
                                                            @foreach($states as $state)
                                                                <option value="{{$state->id}}" {{ $state->id == $sponsor->state_id ? 'selected' : '' }} {{ old('state_id') == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <div>
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i>Editar</button>
                                    
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
@section('js')
<script>
    $(document).ready(function (e) {
        $('#logo').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

</script>
<script>
    @foreach($sponsors as $sponsor)
    $(document).ready(function (e) {
        $('#logos_{{$loop->iteration}}').change(function(){
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
