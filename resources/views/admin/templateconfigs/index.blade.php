@extends('layouts.app')
@section('title', 'Configuración plantilla principal')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administración general de la aplicación</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Administración general de la aplicación</li>
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
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default">Editar</button>
                    <div>
                        @foreach($templateconfigs as $templateconfig)
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white" style="background: url({{asset('storage/'. $templateconfig->img_main)}}) center center;">
                                <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
                                <h5 class="widget-user-desc text-right">Web Designer</h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle" src="../dist/img/user3-128x128.jpg" alt="User Avatar">
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">3,200</h5>
                                            <span class="description-text">SALES</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">13,000</h5>
                                            <span class="description-text">FOLLOWERS</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header">35</h5>
                                            <span class="description-text">PRODUCTS</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para crear una noticia -->
        <div class="modal fade" id="modal-default"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar aplicación</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form action="{{route('admin.templateconfigs.update',$templateconfig)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                <div class="d-flex justify-content-end">
                                    <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="logo"><span class="text-danger">*</span> Logo:</label>
                                            <input type="file" name="logo" value="{{$templateconfig->logo}}" class="form-control form-control-border" id="logo">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="img_main">Imagen principal:</label>
                                            <input type="file" name="img_main" value="{{$templateconfig->img_main}}" class="form-control form-control-border" id="img_main" placeholder="Escriba la URL">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="url_carton">Url carton:</label>
                                            <input type="url" name="url_carton" value="{{$templateconfig->url_carton}}" class="form-control form-control-border" id="url_carton" placeholder="Escriba la URL">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="url_live">Url live:</label>
                                            <input type="url" name="url_live" value="{{$templateconfig->url_live}}" class="form-control form-control-border" id="url_live" placeholder="Escriba la URL">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="price_carton">Precio:</label>
                                            <input type="number" name="price_carton" value="{{$templateconfig->price_carton}}" class="form-control form-control-border" id="price_carton" placeholder="Escriba el precio">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="area">Area:</label>
                                            <input type="text" name="area" value="{{$templateconfig->area}}" class="form-control form-control-border" id="area" placeholder="Escriba el precio">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="area">email:</label>
                                            <input type="text" name="email" value="{{$templateconfig->email}}" class="form-control form-control-border" id="email" placeholder="el email">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone:</label>
                                            <input type="text" name="phone" value="{{$templateconfig->phone}}" class="form-control form-control-border" id="phone" placeholder="el email">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description"><span class="text-danger">*</span> Descripción 1</label>
                                    <textarea id="compose-textarea" name="description_carton" required class="form-control" style="height: 500px!important;">
                                        {{$templateconfig->description_carton}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description"><span class="text-danger">*</span> Descripción 2</label>
                                    <textarea id="compose-textarea-2" name="description_live" required class="form-control" style="height: 500px!important;">
                                        {{$templateconfig->description_live}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-warning">Editar</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

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
        $(function () {
            //Add text editor
            $('#compose-textarea-2').summernote(
                {
                    tabsize: 2,
                    height: 200
                }
            );
        });

    </script>
@endsection
