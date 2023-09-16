@extends('layouts.app')
@section('title', 'Dinámica del Juego')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dinámica del Juego</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Dinámica del Juego</li>
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
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-dynamicgame">Crear Dinámica</button>
                                </div>
                                <div class="col-12 col-md-9 d-flex justify-content-end">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">
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
                                        <th scope="col">Logo</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Letra</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dynamicgames as $dynamicgame)
                                        <tr class="text-center">
                                            <th scope="row" style="width: 50px;">{{$dynamicgame->id}}</th>
                                            <td style="width: 100px;"><img width="14px" src="{{asset('storage/' . $dynamicgame->logo)}}" alt="{{$dynamicgame->title}}"></td>
                                            <td>{{$dynamicgame->title}}</td>
                                            <td>{{$dynamicgame->state->name}}</td>
                                            <td>{{$dynamicgame->letra}}</td>
                                            <td style="width: 100px;"><button type="button" data-toggle="modal" data-target="#modal-edit-dynamicgame_{{$loop->iteration}}" class="btn btn-warning">Editar</button></td>
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
        <div class="modal fade" id="modal-dynamicgame"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nueva Dinámica</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form action="{{route('admin.dynamicgames.store')}}" method="post" enctype="multipart/form-data">
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
                                    <div class="form-group">
                                        <label for="title"><span class="text-danger">*</span> Título:</label>
                                        <input type="text" name="title" required class="form-control form-control-border" id="title" placeholder="Título">
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
    
    
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="logo"><span class="text-danger">*</span> Imagen:</label>
                                                <input type="file" name="logo" required class="form-control form-control-border" id="logo">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="letra">Letra:</label>
                                                <input type="text" name="letra" class="form-control form-control-border" id="letra" placeholder="Escriba la letra.">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Filas:</label>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="fila1" name="fila[]" value="1">
                                                    <label for="fila1" class="custom-control-label">Primera Fila</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="fila2" name="fila[]" value="2">
                                                    <label for="fila2" class="custom-control-label">Segunda Fila</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="fila3" name="fila[]" value="3">
                                                    <label for="fila3" class="custom-control-label">Tercera Fila</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="fila4" name="fila[]" value="4">
                                                    <label for="fila4" class="custom-control-label">Cuarta Fila</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="fila5" name="fila[]" value="5">
                                                    <label for="fila5" class="custom-control-label">Quinta Fila</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Columnas:</label>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="columna1" name="colum[]" value="1">
                                                    <label for="columna1" class="custom-control-label">Primera Columnas</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="columna2" name="colum[]" value="2">
                                                    <label for="columna2" class="custom-control-label">Segunda Columnas</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="columna3" name="colum[]" value="3">
                                                    <label for="columna3" class="custom-control-label">Tercera Columnas</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="columna4" name="colum[]" value="4">
                                                    <label for="columna4" class="custom-control-label">Cuarta Columnas</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="columna5" name="colum[]" value="5">
                                                    <label for="columna5" class="custom-control-label">Quinta Columnas</label>
                                                </div>
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
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        @foreach($dynamicgames as $dynamicgame)
            <!-- Modal para editar una noticia -->
            <div class="modal fade" id="modal-edit-dynamicgame_{{$loop->iteration}}"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar dinámica del juego</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <form action="{{route('admin.dynamicgames.update', $dynamicgame)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-3">
                                        <img src="{{asset('storage/' . $dynamicgame->logo)}}" id="imagenSeleccionadas_{{$loop->iteration}}" class="card-img-top img-fluid" width="17px" height="27px">
                                    </div>
                                    <div class="col-9">
                                        <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                            <div class="d-flex justify-content-end">
                                                <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="title"><span class="text-danger">*</span> Título:</label>
                                                <input type="text" value="{{$dynamicgame->title}}" name="title" required class="form-control form-control-border" id="title" placeholder="Título">
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="logos_{{$loop->iteration}}"><span class="text-danger">*</span> Imagen:</label>
                                                        <input type="file" value="{{$dynamicgame->logo}}" name="logo"  class="form-control form-control-border" id="logos_{{$loop->iteration}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="letra">Letra:</label>
                                                        <input type="text" value="{{$dynamicgame->letra}}" name="letra" class="form-control form-control-border" id="letra" placeholder="Escriba la letra">
                                                    </div>
                                                </div>
        
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="state_id">Estado:</label>
                                                        <select class="custom-select form-control-border" name="state_id" id="state_id">
                                                            @foreach($states as $state)
                                                                <option value="{{$state->id}}" {{ $state->id == $dynamicgame->state_id ? 'selected' : '' }} {{ old('state_id') == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
        
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">*</span> Filas:</label>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="editfila1" name="fila[]" value="1" {{ in_array('1', json_decode($dynamicgame->fila)) ? 'checked' : '' }}>
                                                            <label for="editfila1" class="custom-control-label">Primera Fila</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="editfila2" name="fila[]" value="2" {{ in_array('2', json_decode($dynamicgame->fila)) ? 'checked' : '' }}>
                                                            <label for="editfila2" class="custom-control-label">Segunda Fila</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="editfila3" name="fila[]" value="3" {{ in_array('3', json_decode($dynamicgame->fila)) ? 'checked' : '' }}>
                                                            <label for="editfila3" class="custom-control-label">Tercera Fila</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="editfila4" name="fila[]" value="4" {{ in_array('4', json_decode($dynamicgame->fila)) ? 'checked' : '' }}>
                                                            <label for="editfila4" class="custom-control-label">Cuarta Fila</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="editfila5" name="fila[]" value="5" {{ in_array('5', json_decode($dynamicgame->fila)) ? 'checked' : '' }}>
                                                            <label for="editfila5" class="custom-control-label">Quinta Fila</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">*</span> Columnas:</label>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="editcolumna1" name="colum[]" value="1" {{ in_array('1', json_decode($dynamicgame->colum)) ? 'checked' : '' }}>
                                                            <label for="editcolumna1" class="custom-control-label">Primera Columnas</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="editcolumna2" name="colum[]" value="2" {{ in_array('2', json_decode($dynamicgame->colum)) ? 'checked' : '' }}>
                                                            <label for="editcolumna2" class="custom-control-label">Segunda Columnas</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="editcolumna3" name="colum[]" value="3" {{ in_array('3', json_decode($dynamicgame->colum)) ? 'checked' : '' }}>
                                                            <label for="editcolumna3" class="custom-control-label">Tercera Columnas</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="editcolumna4" name="colum[]" value="4" {{ in_array('4', json_decode($dynamicgame->colum)) ? 'checked' : '' }}>
                                                            <label for="editcolumna4" class="custom-control-label">Cuarta Columnas</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="editcolumna5" name="colum[]" value="5" {{ in_array('5', json_decode($dynamicgame->colum)) ? 'checked' : '' }}>
                                                            <label for="editcolumna5" class="custom-control-label">Quinta Columnas</label>
                                                        </div>
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
                                    <button type="submit" class="btn btn-warning">Editar</button>
                                    <a title="Eliminar" onclick="document.getElementById('eliminardynamicgames_{{ $loop->iteration }}').submit()" class="btn btn-danger ">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <form action="{{route('admin.dynamicgames.destroy',$dynamicgame)}}"  method="POST" id="eliminardynamicgames_{{ $loop->iteration }}">
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
        @foreach($dynamicgames as $dynamicgame)
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
    @foreach($dynamicgames as $dynamicgame)
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
