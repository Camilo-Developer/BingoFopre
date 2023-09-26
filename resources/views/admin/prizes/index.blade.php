@extends('layouts.app')
@section('title', 'Lista de Premios')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Premios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Premios</li>
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
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fa fa-check"></i> Crear Premio</button>
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
                                        <th scope="col">Color</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Creación</th>
                                        <th scope="col">Edición</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $premiosN = 1;
                                    @endphp
                                    @foreach($prizes as $prize)
                                        <tr class="text-center">
                                            <th scope="row" style="width: 50px;">{{$premiosN}}</th>
                                            <td style="width: 100px;"><img width="14px" src="{{asset('storage/' . $prize->imagen)}}" alt="{{$prize->color}}"></td>
                                            <td><div style="width: 100%; display: flex; justify-content: center"> <div style="background: {{$prize->color}}; width: 30px; height: 30px; border-radius: 5px;"></div></div></td>
                                            <td>{{$prize->state->name}}</td>
                                            <td>{{ $prize->created_at->format('Y-m-d')  }}</td>
                                            <td>{{$prize->updated_at->format('Y-m-d')}}</td>
                                            <td style="width: 100px;">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="modal" data-target="#modal-edit-noticia_{{$loop->iteration}}" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                                    <a style="margin-left: 5px" title="Eliminar" onclick="document.getElementById('eliminarApunte_{{ $loop->iteration }}').submit()" class="btn btn-danger ">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <form action="{{route('admin.prizes.destroy',$prize)}}"  method="POST" id="eliminarApunte_{{ $loop->iteration }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @php
                                            $premiosN++;
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{$prizes->links()}}
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-default"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-check-circle"></i> Nuevo Premio</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{route('admin.prizes.store')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="color"><span class="text-danger">*</span> Color:</label>
                                            <input type="color" name="color" required class="form-control form-control-border" id="color">
                                        </div>
                                        <div class="form-group">
                                            <label for="imagen"><span class="text-danger">*</span> Imagen:</label>
                                            <input type="file" name="imagen" required class="form-control form-control-border" id="imagen">
                                        </div>
                                        <div class="form-group">
                                            <label for="state_id">Estado:</label>
                                            <select class="custom-select form-control-border" name="state_id" id="state_id">
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
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
            </div>
        </div>
        @foreach($prizes as $prize)
            <div class="modal fade" id="modal-edit-noticia_{{$loop->iteration}}"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-edit"></i> Editar Premio</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <form action="{{route('admin.prizes.update', $prize)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-3">
                                        <img src="{{asset('storage/' . $prize->imagen)}}" id="imagenSeleccionadas_{{$loop->iteration}}" class="card-img-top img-fluid" width="17px" height="27px">
                                    </div>
                                    <div class="col-9">
                                        <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                            <div class="d-flex justify-content-end">
                                                <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                            </div>

                                            <div class="form-group">
                                                <label for="color"><span class="text-danger">*</span> Color:</label>
                                                <input type="color" value="{{$prize->color}}" name="color" required class="form-control form-control-border" id="color">
                                            </div>
                                            <div class="form-group">
                                                <label for="imagen"><span class="text-danger">*</span> Imagen:</label>
                                                <input type="file" value="{{$prize->imagen}}" name="imagen"  class="form-control form-control-border" id="imagenes_{{$loop->iteration}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="state_id">Estado:</label>
                                                <select class="custom-select form-control-border" name="state_id" id="state_id">
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}" {{ $state->id == $prize->state_id ? 'selected' : '' }} {{ old('state_id') == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="description"><span class="text-danger">*</span> Descripción</label>
                                                <textarea id="editNovedad_{{$loop->iteration}}" name="description" required class="form-control" style="height: 500px!important;">
                                                    {!! $prize->description !!}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                                <div>
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button>

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
        $(function () {
            $('#compose-textarea').summernote(
                {
                    tabsize: 2,
                    height: 200
                }
            );
        });
        @foreach($prizes as $prize)
        $(function () {
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
        @foreach($prizes as $prize)
        $(document).ready(function (e) {
            $('#imagenes_{{$loop->iteration}}').change(function(){
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
