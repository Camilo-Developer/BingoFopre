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
                    <div class="row">
                        @foreach($templateconfigs as $templateconfig)
                            <div class="col-12">
                                <label>Información del sitio principal</label>
                                <div class="row">
                                    <div class="col-2 mb-3">
                                        <label >Logo</label>
                                        <img width="50px" src="{{asset('storage/'. $templateconfig->logo)}}" alt="">
                                    </div>
                                    <div class="col-2 mb-3">
                                        <label>Imagen principal</label>
                                        <img width="50px" src="{{asset('storage/'. $templateconfig->img_main)}}" alt="">
                                    </div>
                                    <div class="col-2 mb-3">
                                        <label>Gradiente</label>
                                        <div style="width: 50px; height: 50px; background: linear-gradient(195deg, {{$templateconfig->color_main_one}}, {{$templateconfig->color_main_two}})">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label> Información cartones</label>
                                <div class="row">
                                    <div class="col-2 mb-3">
                                        <label >Imagen Cartón</label>
                                        <img width="50px" src="{{asset('storage/'. $templateconfig->img_carton)}}" alt="">
                                    </div>
                                    <div class="col-12">
                                        <label>Url del cartón</label>
                                        <div>
                                            {!! $templateconfig->url_carton !!}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label>Descripción del carton</label>
                                        <div>
                                            {!! $templateconfig->description_carton !!}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label>Precio del carton</label>
                                        <p>$ {{number_format(intval($templateconfig->price_carton))}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label >Información Live</label>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label >Imagen Live</label>
                                        <img width="50px" src="{{asset('storage/'. $templateconfig->img_live)}}" alt="">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label>Url de la trasmición</label>
                                        <p>{{$templateconfig->url_live}}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label>Descripcón de la trasmición</label><br>
                                        {!! $templateconfig->description_live !!}
                                    </div>
                                </div>
                            </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <label>Area de la universidad</label>
                                    <p>{{$templateconfig->area}}</p>
                                </div>
                                <div class="col-4">
                                    <label>Correo de la universidad</label>
                                    <p>{{$templateconfig->email}}</p>
                                </div>
                                <div class="col-4">
                                    <label>Telefono de la universidad</label>
                                    <p>{{$templateconfig->phone}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label>Colores del texto</label>
                            <div class="row">
                                <div class="col-3">
                                    <label>Color texto 1</label>
                                    <div style="width: 50px; height:25px; border-radius: 6px; background: {{$templateconfig->color_text_one}}"> </div>
                                </div>
                                <div class="col-3">
                                    <label>Color texto 2</label>
                                    <div style="width: 50px; height:25px; border-radius: 6px; background: {{$templateconfig->color_text_two}}"> </div>
                                </div>
                                <div class="col-3">
                                    <label>Color texto 3</label>
                                    <div style="width: 50px; height:25px; border-radius: 6px; background: {{$templateconfig->color_text_three}}"> </div>
                                </div>
                                <div class="col-3">
                                    <label>Color texto 4</label>
                                    <div style="width: 50px; height:25px; border-radius: 6px; background: {{$templateconfig->color_text_four}}"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label>Informacion del login</label>
                            <div class="row">
                                <div class="col-2 mb-3">
                                    <label >Imagen del Login</label>
                                    <img width="50px" src="{{asset('storage/'. $templateconfig->img_login)}}" alt="">
                                </div>
                                <div class="col-2">
                                    <label>Color de fondo del button</label>
                                    <div style="height: 50px; width: 50px; background: linear-gradient(195deg, {{$templateconfig->color_login_one}}, {{$templateconfig->color_login_two}})">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label>Color de fondo del button</label>
                                    <div style="height: 50px; width: 50px; background: linear-gradient(195deg, {{$templateconfig->color_login_hover_three}}, {{$templateconfig->color_login_hover_four}})">
                                    </div>
                                </div>
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
                                        <div style="display: flex; justify-content: center">
                                            <img  style="width: 80px; height: 80px;" src="{{asset('storage/'. $templateconfig->logo)}}" id="imagenSeleccionadaLogo" class="card-img-top img-fluid">
                                        </div>

                                        <div class="form-group">
                                            <label for="logo"><span class="text-danger">*</span> Logo:</label>
                                            <input type="file" name="logo" value="{{$templateconfig->logo}}" class="form-control form-control-border" id="logo">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div style="display: flex; justify-content: center">
                                            <img  style="width: 80px; height: 80px;" src="{{asset('storage/'. $templateconfig->img_main)}}" id="imagenSeleccionadaImgMain" class="card-img-top img-fluid">
                                        </div>
                                        <div class="form-group">
                                            <label for="img_main">Imagen principal:</label>
                                            <input type="file" name="img_main" value="{{$templateconfig->img_main}}" class="form-control form-control-border" id="img_main" placeholder="Escriba la URL">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div style="width: 100%;height: 70px;" id="gradientDiv" class="gradient-div"></div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="color_main_one">Color principal 1:</label>
                                            <input type="color" name="color_main_one" value="{{$templateconfig->color_main_one}}" class="form-control form-control-border" id="color_main_one" placeholder="Escriba la URL">
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-6">

                                        <div class="form-group">
                                            <label for="color_main_two">Color principal 2:</label>
                                            <input type="color" name="color_main_two" value="{{$templateconfig->color_main_two}}" class="form-control form-control-border" id="color_main_two" placeholder="Escriba la URL">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div style="display: flex; justify-content: center">
                                            <img  style="width: 80px; height: 80px;" src="{{asset('storage/'. $templateconfig->img_carton)}}" id="imagenSeleccionadaImgCarton" class="card-img-top img-fluid">
                                        </div>

                                        <div class="form-group">
                                            <label for="img_carton">Imagén del carton:</label>
                                            <input type="file" name="img_carton" value="{{$templateconfig->img_carton}}" class="form-control form-control-border" id="img_carton" placeholder="Escriba la URL">
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
                                            <label for="price_carton">Precio:</label>
                                            <input type="number" name="price_carton" value="{{$templateconfig->price_carton}}" class="form-control form-control-border" id="price_carton" placeholder="Escriba el precio">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div style="display: flex; justify-content: center">
                                            <img  style="width: 80px; height: 80px;" src="{{asset('storage/'. $templateconfig->img_live)}}" id="imagenSeleccionadaImgLive" class="card-img-top img-fluid">
                                        </div>

                                        <div class="form-group">

                                            <label for="img_live">Imagén del Live:</label>
                                            <input type="file" name="img_live" value="{{$templateconfig->img_live}}" class="form-control form-control-border" id="img_live" placeholder="Escriba la URL">
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



                                <div class="col-12 col-md-6">

                                    <div class="form-group">
                                        <label for="color_text_one">Color texto 1:</label>
                                        <input type="color" name="color_text_one" value="{{$templateconfig->color_text_one}}" class="form-control form-control-border" id="color_text_one" placeholder="Escriba la URL">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">

                                    <div class="form-group">
                                        <label for="color_text_two">Color texto 2:</label>
                                        <input type="color" name="color_text_two" value="{{$templateconfig->color_text_two}}" class="form-control form-control-border" id="color_text_two" placeholder="Escriba la URL">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">

                                    <div class="form-group">
                                        <label for="color_text_three">Color texto 3:</label>
                                        <input type="color" name="color_text_three" value="{{$templateconfig->color_text_three}}" class="form-control form-control-border" id="color_text_three" placeholder="Escriba la URL">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">

                                    <div class="form-group">
                                        <label for="color_text_four">Color texto 4:</label>
                                        <input type="color" name="color_text_four" value="{{$templateconfig->color_text_four}}" class="form-control form-control-border" id="color_text_four" placeholder="Escriba la URL">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div style="display: flex; justify-content: center">
                                        <img  style="width: 80px; height: 80px;" src="{{asset('storage/'. $templateconfig->img_login)}}" id="imagenSeleccionadaImgLogin" class="card-img-top img-fluid">
                                    </div>

                                    <div class="form-group">
                                        <label for="img_login">Imagen Login:</label>
                                        <input type="file" name="img_login" value="{{$templateconfig->img_login}}" class="form-control form-control-border" id="img_login" placeholder="el email">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">

                                    <div class="form-group">
                                        <label for="color_login_one">Color Login 1:</label>
                                        <input type="color" name="color_login_one" value="{{$templateconfig->color_login_one}}" class="form-control form-control-border" id="color_login_one" placeholder="Escriba la URL">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">

                                    <div class="form-group">
                                        <label for="color_login_two">Color Login 2:</label>
                                        <input type="color" name="color_login_two" value="{{$templateconfig->color_login_two}}" class="form-control form-control-border" id="color_login_two" placeholder="Escriba la URL">
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">

                                    <div class="form-group">
                                        <label for="color_login_hover_three">Color Login Hover 1:</label>
                                        <input type="color" name="color_login_hover_three" value="{{$templateconfig->color_login_hover_three}}" class="form-control form-control-border" id="color_login_hover_three" placeholder="Escriba la URL">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">

                                    <div class="form-group">
                                        <label for="color_login_hover_four">Color Login Hover 2:</label>
                                        <input type="color" name="color_login_hover_four" value="{{$templateconfig->color_login_hover_four}}" class="form-control form-control-border" id="color_login_hover_four" placeholder="Escriba la URL">
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
    <script>
        $(document).ready(function (e) {
            $('#logo').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionadaLogo').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

    </script>
    <script>
        $(document).ready(function (e) {
            $('#img_main').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionadaImgMain').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

    </script>

<script>
    $(document).ready(function (e) {
        $('#img_carton').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionadaImgCarton').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

</script>

<script>
    $(document).ready(function (e) {
        $('#img_live').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionadaImgLive').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

</script>

<script>
    $(document).ready(function (e) {
        $('#img_login').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionadaImgLogin').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

</script>
    <script>
        $(document).ready(function() {
            // Función para actualizar el fondo del div con el gradiente lineal
            function updateGradient() {
                const colorMainOne = $('#color_main_one').val();
                const colorMainTwo = $('#color_main_two').val();

                // Actualiza el fondo del div con el gradiente lineal
                $('#gradientDiv').css('background', `linear-gradient(195deg, ${colorMainOne}, ${colorMainTwo})`);
            }

            // Escucha los eventos input en los inputs de color
            $('#color_main_one, #color_main_two').on('input', updateGradient);

            // Llama a la función para establecer el fondo inicial
            updateGradient();
        });

    </script>


@endsection
