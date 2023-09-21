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
    <link href="{{asset('assets/css/style.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/style2.css')}}" rel="stylesheet" />

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
                                    <a href="https://evento.uniandes.edu.co/es/bingo-fopre-2022/Compra-de-cartones" role="button" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                                        <i class="material-icons opacity-6 me-2 text-md">add_shopping_cart</i>
                                        Compra Online
                                    </a>
                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a onclick="document.getElementById('cerrar').submit()"
                                       class="btn btn-sm  bg-gradient-primary  mb-0 ms-auto d-lg-none d-block" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cerrar Sesión">
                                        <i class="material-icons  text-md">power_settings_new</i> Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
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

                            <ul class="navbar-nav mx-2 d-lg-block d-none">
                                <li class="nav-item">
                                    <a  onclick="document.getElementById('cerrar').submit()" class="btn btn-sm   bg-gradient-primary  mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cerrar Sesión">
                                        <i class="material-icons opacity-6  text-md">power_settings_new</i>
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
                                    <a href="https://evento.uniandes.edu.co/es/bingo-fopre-2022/Compra-de-cartones" role="button" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                                        <i class="material-icons opacity-6 me-2 text-md">add_shopping_cart</i>
                                        Compra Online
                                    </a>
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

<header>
    <div class="page-header min-vh-50"
         style="background-image: url('https://images.unsplash.com/photo-1497377825569-02ad2f9edb81?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1966&q=80');"
         loading="lazy">
        <span class="mask bg-gradient-dark"></span>
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 d-flex justify-content-center flex-column text-center position-absolute top-0 h-100">
                    <div class="mx-auto text-start">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6 mb-4">
    @yield('contents')


</div>
<footer class="footer pt-5 mt-5">
    <div class="container">
        <div class=" row">
            <div class="col-md-12 mb-4 ms-auto">
                <div class="d-flex justify-content-center">
                    <div>
                        <div class="d-flex">
                            <a href="{{route('bingofopre.index')}}">
                                @foreach($templateconfigs as $templateconfig)
                                    <img src="{{'storage/'.$templateconfig->logo}}" class="mb-3 footer-logo" alt="logo">
                                @endforeach
                            </a>
                            <h6 class="font-weight-bolder mb-4">Bingo Fopre</h6>
                        </div>
                        <div >
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
                    <p class="text-dark my-4 text-sm font-weight-normal">
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

<script src="{{asset('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>

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
<script>
</script>
<script src="{{asset('assets/js/plugins/glide.min.js')}}"></script>
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
@yield('js')
</body>

</html>
