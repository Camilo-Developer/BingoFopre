<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
       @yield('title') | Bingo Fopre
    </title>

    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link rel="icon" href="{{asset('logo.png')}}" type="image/x-icon">
    <link rel="icon" sizes="192x192" href="{{asset('logo.png')}}">
    <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <link href="{{--asset('assets/css/style.min.css')--}}" rel="stylesheet" />
    <link href="{{asset('assets/css/style2.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/ptp.css')}}" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link id="pagestyle" href="assets/css/material-kit-pro.min.css" rel="stylesheet" />

    <style>
        .async-hide {
            opacity: 0 !important
        }
        @foreach($templateconfigs as $templateconfig)
        :root{
            --color_login_one:{{$templateconfig->color_login_one}};
            --color_login_two:{{$templateconfig->color_login_two}};
            --color_login_hover_three:{{$templateconfig->color_login_hover_three}};
            --color_login_hover_four:{{$templateconfig->color_login_hover_four}};
            --color_main_one:{{$templateconfig->color_main_one}};
            --color_main_two:{{$templateconfig->color_main_two}};
            --color_text_one:{{$templateconfig->color_text_one}};
            --color_text_two:{{$templateconfig->color_text_two}};
            --color_text_three:{{$templateconfig->color_text_three}};
            --color_text_four:{{$templateconfig->color_text_four}};

        }
        @endforeach
        .accordion-body h1,
        .accordion-body h2,
        .accordion-body h3,
        .accordion-body h4,
        .accordion-body h5,
        .accordion-body h6{
            color: var(--color_main_one);
        }
        .accordion-body p{
            color: var(--color_main_two);
        }

    </style>
</head>
<body class="automotive">
    <form action="{{route('logout')}}" method="post" id="cerrar">
        @csrf
    </form>
    <form action="{{route('logout')}}" method="post" id="cerrar2">
        @csrf
    </form>
<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav
                class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid px-0">
                    <a class="navbar-brand font-weight-bolder ms-sm-3  d-none d-md-block"
                       href="{{route('bingofopre.index')}}" rel="tooltip"
                       title="Bingo Fopre" data-placement="bottom">
                        Bingo Fopre
                    </a>
                    <a class="navbar-brand font-weight-bolder ms-sm-3  d-block d-md-none"
                       href="{{route('bingofopre.index')}}" rel="tooltip"
                       title="Bingo Fopre" data-placement="bottom">
                        Bingo Fopre
                    </a>
                    @if(auth()->check())

                        @can('addToCart')

                        @if(session('cart'))
                            @php $cartCount = count(session('cart')); @endphp
                            <a href="{{route('user.cart.index')}}"
                               class="btn btn-sm  bg-gradient-primary  mb-0 ms-auto d-lg-none d-block" title="Ver Carrito">
                                <i class="material-icons  text-md">shopping_cart</i> {{ $cartCount }}
                            </a>
                        @else
                            <a href="{{route('user.cart.index')}}"
                               class="btn btn-sm  bg-gradient-primary  mb-0 ms-auto d-lg-none d-block" title="Ver Carrito">
                                <i class="material-icons  text-md">shopping_cart</i> 0
                            </a>
                        @endif
                        @endcan

                    @else
                        <a href="{{route('login')}}"
                           class="btn btn-sm  bg-gradient-primary  mb-0 ms-auto d-lg-none d-block" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Iniciar Sesión">
                            <i class="material-icons  text-md">person</i>
                        </a>
                    @endif



                    <button class="navbar-toggler shadow-none ms-md-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                    aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                    </button>
                    <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">

                        @if(auth()->check())
                            <ul class="navbar-nav navbar-nav-hover ms-auto">
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a href="{{route('dashboard')}}" role="button" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
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
                                    @foreach($templateconfigs as $templateconfig)
                                        <a href="{{$templateconfig->url_carton}}" role="button" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                                            <i class="material-icons opacity-6 me-2 text-md">add_shopping_cart</i>
                                            Compra Online
                                        </a>
                                    @endforeach
                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a  class=" mb-0  ms-auto d-lg-none d-block" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cerrar Sesión">

                                        <div class="background background--light">
                                            <button id="cerrar-button" class="logoutButton logoutButton--dark" style="--figure-duration: 100; --transform-figure: none; --walking-duration: 100; --transform-arm1: none; --transform-wrist1: none; --transform-arm2: none; --transform-wrist2: none; --transform-leg1: none; --transform-calf1: none; --transform-leg2: none; --transform-calf2: none;">
                                                <svg class="doorway" viewBox="0 0 100 100">
                                                    <path d="M93.4 86.3H58.6c-1.9 0-3.4-1.5-3.4-3.4V17.1c0-1.9 1.5-3.4 3.4-3.4h34.8c1.9 0 3.4 1.5 3.4 3.4v65.8c0 1.9-1.5 3.4-3.4 3.4z"></path>
                                                    <path class="bang" d="M40.5 43.7L26.6 31.4l-2.5 6.7zM41.9 50.4l-19.5-4-1.4 6.3zM40 57.4l-17.7 3.9 3.9 5.7z"></path>
                                                </svg>
                                                <svg class="figure" viewBox="0 0 100 100">
                                                    <circle cx="52.1" cy="32.4" r="6.4"></circle>
                                                    <path d="M50.7 62.8c-1.2 2.5-3.6 5-7.2 4-3.2-.9-4.9-3.5-4-7.8.7-3.4 3.1-13.8 4.1-15.8 1.7-3.4 1.6-4.6 7-3.7 4.3.7 4.6 2.5 4.3 5.4-.4 3.7-2.8 15.1-4.2 17.9z"></path>
                                                    <g class="arm1">
                                                        <path d="M55.5 56.5l-6-9.5c-1-1.5-.6-3.5.9-4.4 1.5-1 3.7-1.1 4.6.4l6.1 10c1 1.5.3 3.5-1.1 4.4-1.5.9-3.5.5-4.5-.9z"></path>
                                                        <path class="wrist1" d="M69.4 59.9L58.1 58c-1.7-.3-2.9-1.9-2.6-3.7.3-1.7 1.9-2.9 3.7-2.6l11.4 1.9c1.7.3 2.9 1.9 2.6 3.7-.4 1.7-2 2.9-3.8 2.6z"></path>
                                                    </g>
                                                    <g class="arm2">
                                                        <path d="M34.2 43.6L45 40.3c1.7-.6 3.5.3 4 2 .6 1.7-.3 4-2 4.5l-10.8 2.8c-1.7.6-3.5-.3-4-2-.6-1.6.3-3.4 2-4z"></path>
                                                        <path class="wrist2" d="M27.1 56.2L32 45.7c.7-1.6 2.6-2.3 4.2-1.6 1.6.7 2.3 2.6 1.6 4.2L33 58.8c-.7 1.6-2.6 2.3-4.2 1.6-1.7-.7-2.4-2.6-1.7-4.2z"></path>
                                                    </g>
                                                    <g class="leg1">
                                                        <path d="M52.1 73.2s-7-5.7-7.9-6.5c-.9-.9-1.2-3.5-.1-4.9 1.1-1.4 3.8-1.9 5.2-.9l7.9 7c1.4 1.1 1.7 3.5.7 4.9-1.1 1.4-4.4 1.5-5.8.4z"></path>
                                                        <path class="calf1" d="M52.6 84.4l-1-12.8c-.1-1.9 1.5-3.6 3.5-3.7 2-.1 3.7 1.4 3.8 3.4l1 12.8c.1 1.9-1.5 3.6-3.5 3.7-2 0-3.7-1.5-3.8-3.4z"></path>
                                                    </g>
                                                    <g class="leg2">
                                                        <path d="M37.8 72.7s1.3-10.2 1.6-11.4 2.4-2.8 4.1-2.6c1.7.2 3.6 2.3 3.4 4l-1.8 11.1c-.2 1.7-1.7 3.3-3.4 3.1-1.8-.2-4.1-2.4-3.9-4.2z"></path>
                                                        <path class="calf2" d="M29.5 82.3l9.6-10.9c1.3-1.4 3.6-1.5 5.1-.1 1.5 1.4.4 4.9-.9 6.3l-8.5 9.6c-1.3 1.4-3.6 1.5-5.1.1-1.4-1.3-1.5-3.5-.2-5z"></path>
                                                    </g>
                                                </svg>
                                                <svg class="door" viewBox="0 0 100 100">
                                                    <path d="M93.4 86.3H58.6c-1.9 0-3.4-1.5-3.4-3.4V17.1c0-1.9 1.5-3.4 3.4-3.4h34.8c1.9 0 3.4 1.5 3.4 3.4v65.8c0 1.9-1.5 3.4-3.4 3.4z"></path>
                                                    <circle cx="66" cy="50" r="3.7"></circle>
                                                </svg>
                                            </button>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            @can('addToCart')
                                @if(session('cart'))
                                    @php $cartCount = count(session('cart')); @endphp
                                    <ul class="navbar-nav d-lg-block d-none">
                                        <li class="nav-item">
                                            <a href="{{route('user.cart.index')}}" class="btn btn-sm  bg-gradient-primary  mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ver Carrito">
                                                <i class="material-icons opacity-6  text-md">shopping_cart</i> {{ $cartCount }}
                                            </a>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="navbar-nav d-lg-block d-none">
                                        <li class="nav-item">
                                            <a href="{{route('user.cart.index')}}" class="btn btn-sm  bg-gradient-primary  mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ver Carrito">
                                                <i class="material-icons opacity-6  text-md">shopping_cart</i> 0
                                            </a>
                                        </li>
                                    </ul>
                                @endif
                            @endcan

                            <ul class="navbar-nav mx-2 d-lg-block d-none">
                                <li class="nav-item">
                                    <a  class=" mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cerrar Sesión">

                                        <div class="background background--light">
                                            <button id="cerrar-button2" class="logoutButton logoutButton--dark" style="--figure-duration: 100; --transform-figure: none; --walking-duration: 100; --transform-arm1: none; --transform-wrist1: none; --transform-arm2: none; --transform-wrist2: none; --transform-leg1: none; --transform-calf1: none; --transform-leg2: none; --transform-calf2: none;">
                                                <svg class="doorway" viewBox="0 0 100 100">
                                                    <path d="M93.4 86.3H58.6c-1.9 0-3.4-1.5-3.4-3.4V17.1c0-1.9 1.5-3.4 3.4-3.4h34.8c1.9 0 3.4 1.5 3.4 3.4v65.8c0 1.9-1.5 3.4-3.4 3.4z"></path>
                                                    <path class="bang" d="M40.5 43.7L26.6 31.4l-2.5 6.7zM41.9 50.4l-19.5-4-1.4 6.3zM40 57.4l-17.7 3.9 3.9 5.7z"></path>
                                                </svg>
                                                <svg class="figure" viewBox="0 0 100 100">
                                                    <circle cx="52.1" cy="32.4" r="6.4"></circle>
                                                    <path d="M50.7 62.8c-1.2 2.5-3.6 5-7.2 4-3.2-.9-4.9-3.5-4-7.8.7-3.4 3.1-13.8 4.1-15.8 1.7-3.4 1.6-4.6 7-3.7 4.3.7 4.6 2.5 4.3 5.4-.4 3.7-2.8 15.1-4.2 17.9z"></path>
                                                    <g class="arm1">
                                                        <path d="M55.5 56.5l-6-9.5c-1-1.5-.6-3.5.9-4.4 1.5-1 3.7-1.1 4.6.4l6.1 10c1 1.5.3 3.5-1.1 4.4-1.5.9-3.5.5-4.5-.9z"></path>
                                                        <path class="wrist1" d="M69.4 59.9L58.1 58c-1.7-.3-2.9-1.9-2.6-3.7.3-1.7 1.9-2.9 3.7-2.6l11.4 1.9c1.7.3 2.9 1.9 2.6 3.7-.4 1.7-2 2.9-3.8 2.6z"></path>
                                                    </g>
                                                    <g class="arm2">
                                                        <path d="M34.2 43.6L45 40.3c1.7-.6 3.5.3 4 2 .6 1.7-.3 4-2 4.5l-10.8 2.8c-1.7.6-3.5-.3-4-2-.6-1.6.3-3.4 2-4z"></path>
                                                        <path class="wrist2" d="M27.1 56.2L32 45.7c.7-1.6 2.6-2.3 4.2-1.6 1.6.7 2.3 2.6 1.6 4.2L33 58.8c-.7 1.6-2.6 2.3-4.2 1.6-1.7-.7-2.4-2.6-1.7-4.2z"></path>
                                                    </g>
                                                    <g class="leg1">
                                                        <path d="M52.1 73.2s-7-5.7-7.9-6.5c-.9-.9-1.2-3.5-.1-4.9 1.1-1.4 3.8-1.9 5.2-.9l7.9 7c1.4 1.1 1.7 3.5.7 4.9-1.1 1.4-4.4 1.5-5.8.4z"></path>
                                                        <path class="calf1" d="M52.6 84.4l-1-12.8c-.1-1.9 1.5-3.6 3.5-3.7 2-.1 3.7 1.4 3.8 3.4l1 12.8c.1 1.9-1.5 3.6-3.5 3.7-2 0-3.7-1.5-3.8-3.4z"></path>
                                                    </g>
                                                    <g class="leg2">
                                                        <path d="M37.8 72.7s1.3-10.2 1.6-11.4 2.4-2.8 4.1-2.6c1.7.2 3.6 2.3 3.4 4l-1.8 11.1c-.2 1.7-1.7 3.3-3.4 3.1-1.8-.2-4.1-2.4-3.9-4.2z"></path>
                                                        <path class="calf2" d="M29.5 82.3l9.6-10.9c1.3-1.4 3.6-1.5 5.1-.1 1.5 1.4.4 4.9-.9 6.3l-8.5 9.6c-1.3 1.4-3.6 1.5-5.1.1-1.4-1.3-1.5-3.5-.2-5z"></path>
                                                    </g>
                                                </svg>
                                                <svg class="door" viewBox="0 0 100 100">
                                                    <path d="M93.4 86.3H58.6c-1.9 0-3.4-1.5-3.4-3.4V17.1c0-1.9 1.5-3.4 3.4-3.4h34.8c1.9 0 3.4 1.5 3.4 3.4v65.8c0 1.9-1.5 3.4-3.4 3.4z"></path>
                                                    <circle cx="66" cy="50" r="3.7"></circle>
                                                </svg>
                                            </button>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav mx-2 d-lg-block d-none">
                                <li class="nav-item">
                                    <a href="{{route('dashboard')}}" class="avatar avatar-sm rounded-circle"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{auth()->user()->email}}">
                                        <img alt="Image placeholder" src="https://ui-avatars.com/api/?name={{ substr(auth()->user()->name, 0, 1) . substr(auth()->user()->lastname, 0, 1) }}&color=7F9CF5&background=EBF4FF">
                                    </a>
                                </li>
                            </ul>

                        @else
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
                                    @foreach($templateconfigs as $templateconfig)
                                        <a href="{{$templateconfig->url_carton}}" role="button" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                                            <i class="material-icons opacity-6 me-2 text-md">add_shopping_cart</i>
                                            Compra Online
                                        </a>
                                    @endforeach
                                </li>
                            </ul>
                            <ul class="navbar-nav d-lg-block d-none">
                                <li class="nav-item">
                                    <a href="{{route('login')}}" class="btn btn-sm  bg-gradient-primary  mb-0"
                                    >Iniciar Sesión</a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </nav>

        </div>
    </div>
</div>

<header class="header-2">
    @foreach($templateconfigs as $templateconfig)
    <div class="page-header min-vh-75" style="background-image: url({{asset('storage/'. $templateconfig->img_main)}})" loading="lazy">
        <span class="mask bg-gradient-primary-main opacity-4"></span>
    </div>
    @endforeach
</header>
<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
    @yield('contents')


</div>
    <footer class="footer pt-5 mt-5">
        <div class="container">
            <div class=" row">
                <div class="col-md-12 mb-4 ms-auto">
                    <div class="row ">
                        <div class="col-12 col-md-6">
                            <div class="d-flex justify-content-center">
                                <div class="">
                                    <a href="{{route('bingofopre.index')}}">
                                        @foreach($templateconfigs as $templateconfig)
                                            <img src="{{'storage/'.$templateconfig->logo}}" class="mb-3 footer-logo" alt="logo">
                                        @endforeach
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex justify-content-center">
                                <div>
                                    @foreach($templateconfigs as $templateconfig)
                                        <h6 class="font-weight-bolder mb-4">{{$templateconfig->area}}</h6>
                                        <h6 class="font-weight-bolder mb-4">{{$templateconfig->email}}</h6>
                                        <h6 class="font-weight-bolder mb-4 text-center">{{$templateconfig->phone}}</h6>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-center" >
                                <ul class="d-flex flex-row ms-n3 nav">
                                    <li class="nav-item">
                                        <a class="nav-link pe-1" href="https://www.facebook.com/UniandesCol/" target="_blank">
                                            <i class="fab fa-facebook text-lg opacity-8"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pe-1" href="https://twitter.com/Uniandes" target="_blank">
                                            <i class="fab fa-twitter text-lg opacity-8"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pe-1" href="https://www.linkedin.com/company/universidad-de-los-andes" target="_blank">
                                            <i class="fab fa-linkedin-in text-lg opacity-8"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pe-1" href="https://www.instagram.com/uniandes/" target="_blank">
                                            <i class="fab fa-instagram text-lg opacity-8"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pe-1" href="https://www.youtube.com/user/uniandes"
                                           target="_blank">
                                            <i class="fab fa-youtube text-lg opacity-8"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center">
                        <p class="text-dark  text-sm font-weight-normal">
                            Copyright ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>  Universidad de los Andes | Colombia
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{url('recursos/admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{url('recursos/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/pap.js')}}"></script>
<script src="{{asset('assets/js/plugins/typedjs.js')}}"></script>
<script src="{{asset('assets/js/plugins/choices.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/parallax.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/countup.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/nouislider.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/anime.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/chartjs.min.js')}}" type="text/javascript"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{asset('assets/js/material-kit-pro.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/glide.min.js')}}"></script>
    <script src="{{url('recursos/admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
    if (document.getElementsByClassName('glide')) {
        const glider = new Glide('.gliderrr', {
            autoplay: 2000,
            type: 'carousel',
            perView: 4,
            breakpoints: {
                800: {
                    perView: 2
                }
            }
        });
        // The classname for the element that gets transformed
        const tiltableElement = '.glide__container';
        glider.mount();
    };

    if (document.getElementById('choice-button')) {
        var element = document.getElementById('choice-button');
        const example = new Choices(element, {
            searchEnabled: false
        });

    }
    if (document.getElementById('choice-remove-button')) {
        var element = document.getElementById('choice-remove-button');
        const example = new Choices(element, {
            searchEnabled: false
        });
    }

    if (document.getElementById('language-button')) {
        var element = document.getElementById('language-button');
        const example = new Choices(element, {
            searchEnabled: false
        });

    }
    if (document.getElementById('currency-button')) {
        var element = document.getElementById('currency-button');
        const example = new Choices(element, {
            searchEnabled: false
        });
    }
</script>
<script>
    function retrasarEnvio() {
        setTimeout(function () {
            document.getElementById('cerrar').submit();
        }, 1400);
    }
    document.getElementById('cerrar-button').addEventListener('click', function (e) {
        e.preventDefault();
        retrasarEnvio();
    });
</script>
    <script>
        function retrasarEnvio() {
            setTimeout(function () {
                document.getElementById('cerrar2').submit();
            }, 1400);
        }
        document.getElementById('cerrar-button2').addEventListener('click', function (e) {
            e.preventDefault();
            retrasarEnvio();
        });
    </script>
    @include('components.flash_alerts')

    @yield('js')
</body>

</html>
