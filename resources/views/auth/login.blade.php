<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Inicar Sesión | Bingo Fopre
    </title>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="{{asset('assets/css/material-kit-pro.min.css')}}" rel="stylesheet" />
    <link id="pagestyle" href="{{asset('assets/css/style2.css')}}" rel="stylesheet" />
    <style>
        @foreach($templateconfigs as $templateconfig)
        :root{
            --color_login_one:{{$templateconfig->color_login_one}};
            --color_login_two:{{$templateconfig->color_login_two}};
            --color_login_hover_three:{{$templateconfig->color_login_hover_three}};
            --color_login_hover_four:{{$templateconfig->color_login_hover_four}};
        }
        @endforeach
        .async-hide {
            opacity: 0 !important
        }
    </style>
</head>
<body class="sign-in-basic">
<nav
    class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4 ">
    <div class="container">
        <a class="navbar-brand  text-white  d-none d-md-block"
           href=" {{route('bingofopre.index')}} " rel="tooltip"
           title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
            Bingo Fopre
        </a>
            <a class="navbar-brand  text-white  d-block d-md-none"
               href=" {{route('bingofopre.index')}} " rel="tooltip"
               title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
                Bingo Fopre
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
                <ul class="navbar-nav navbar-nav-hover ms-auto">
                    <li class="nav-item dropdown dropdown-hover mx-2">
                        <a href="{{route('bingofopre.index')}}" role="button" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                            <i class="material-icons opacity-6 me-2 text-md">home</i>
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-hover mx-2">
                        <a href="{{route('bingofopre.instructions')}}" role="button" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                            <i class="material-icons opacity-6 me-2 text-md">assignment</i>
                            Instrucciones
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-hover mx-2">
                        <a href="{{route('bingofopre.prizes')}}" role="button" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                            <i class="material-icons opacity-6 me-2 text-md">whatshot</i>
                            Premios
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-hover mx-2">
                        <a href="https://evento.uniandes.edu.co/es/bingo-fopre-2022/Compra-de-cartones" role="button" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                            <i class="material-icons opacity-6 me-2 text-md">add_shopping_cart</i>
                            Compra Online
                        </a>
                    </li>

                </ul>

            </div>
    </div>
</nav>

@foreach ($templateconfigs as $templateconfig)



<div class="page-header align-items-start min-vh-100"
     style="background-image: url({{asset('storage/'. $templateconfig->img_login)}});"
     loading="lazy">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Iniciar Sesión</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('login')}}" method="post" class="text-start">
                            @csrf
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Correo Electrónico</label>
                                <input name="email" type="email" class="form-control">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Contraseña</label>
                                <input name="password" type="password" class="form-control">
                            </div>
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Iniciar Sesión</button>
                            </div>
                            <div class="text-center">
                                <a href="{{route('auth.azure')}}" class="btn bg-gradient-primary w-100 my-4 mb-2">Inicio Cuentas Uniandes</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-12 col-md-6 my-auto">
                    <div class="copyright text-center text-sm text-white text-lg-start">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        Universidad de los Andes | Colombia.
                    </div>
                </div>
                <div class="col-12 col-md-6">

                    <ul class="nav nav-footer justify-content-center justify-content-lg-end text-white">
                        <li class="nav-item">
                            <a class="nav-link text-white pe-1" href="https://www.facebook.com/UniandesCol/" target="_blank">
                                <i class="fab fa-facebook text-lg opacity-8"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white pe-1" href="https://twitter.com/Uniandes" target="_blank">
                                <i class="fab fa-twitter text-lg opacity-8"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white pe-1" href="https://www.linkedin.com/company/universidad-de-los-andes" target="_blank">
                                <i class="fab fa-linkedin-in text-lg opacity-8"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white pe-1" href="https://www.instagram.com/uniandes/" target="_blank">
                                <i class="fab fa-instagram text-lg opacity-8"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white pe-1" href="https://www.youtube.com/user/uniandes"
                               target="_blank">
                                <i class="fab fa-youtube text-lg opacity-8"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
@endforeach
<script src="{{url('recursos/admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('recursos/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script src="{{asset('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/typedjs.js')}}"></script>
<script src="{{asset('assets/js/plugins/parallax.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/nouislider.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/anime.min.js')}}" type="text/javascript"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{asset('assets/js/material-kit-pro.min.js')}}" type="text/javascript"></script>
<script src="{{url('recursos/admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

@include('components.flash_alerts')

</body>
</html>
