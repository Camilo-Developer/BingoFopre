<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Bingo Fopre</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="shortcut icon" href="{{asset('imagen/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{url('recursos/admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{url('recursos/admin/dist/css/style.css')}}">
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/select2/css/select2.min.css')}}" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <form action="{{route('logout')}}" method="post" id="cerrar">
        @csrf
    </form>
    <!-- Preloader -->
    <div class="preloader loader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{url('recursos/admin/dist/img/logo-uniandes-preload.png')}}" alt="AdminLTELogo" height="120" width="280">
    </div>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('dashboard')}}" class="nav-link">Inicio</a>
            </li>
        </ul>
        <!-- Right navbar links -->
        @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Usuario'))

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    @if(session('cart'))

                        @php $cartCount = count(session('cart')); @endphp
                        <a class="nav-link"  href="{{route('user.cart.index')}}" title="Carrito de Compra">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="badge badge-warning navbar-badge" style="font-weight: bold" title="aaa">{{ $cartCount }}</span>
                        </a>
                    @else
                        <a class="nav-link" href="{{route('user.cart.index')}}" title="Carrito de Compra">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="badge badge-warning navbar-badge" style="font-weight: bold" title="aaa">0</span>
                        </a>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-power-off"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" >
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-widget widget-user">

                                                <div class="widget-user-header text-white" style="background: url('data:image/jpeg;base64,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') center center;">
                                                    <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
                                                    <h5 class="widget-user-desc text-right">Web Designer</h5>
                                                </div>
                                                <div class="widget-user-image">
                                                    <img class="img-circle" src="data:image/jpeg;base64,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" alt="User Avatar">
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <div class="col-sm-4 border-right">
                                                            <div class="description-block">
                                                                <h5 class="description-header">3,200</h5>
                                                                <span class="description-text">SALES</span>
                                                            </div>

                                                        </div>

                                                        <div class="col-sm-4 border-right">
                                                            <div class="description-block">
                                                                <h5 class="description-header">13,000</h5>
                                                                <span class="description-text">FOLLOWERS</span>
                                                            </div>

                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="description-block">
                                                                <h5 class="description-header">35</h5>
                                                                <span class="description-text">PRODUCTS</span>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('dashboard')}}" class="dropdown-item dropdown-footer">Todos los pedidos Pendientes</a>
                    </div>
                </li>
            </ul>
        @endif
    </nav>
    <!-- Asidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{route('dashboard')}}" class="brand-link">
            <!--
            <img src="{{url('recursos/admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
             -->
            <span class="brand-text font-weight-light">Bingo Fopre</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <!--
                 <div class="image">
                    <img src="" class="img-circle elevation-2" alt="User Image">
                </div>
                 -->
                <div class="info">
                    @if(auth()->user()->hasRole('Admin'))
                        <a href="{{route('dashboard')}}" class="d-block">{{auth()->user()->name}} {{auth()->user()->lastname}}</a>
                    @elseif(auth()->user()->hasRole('Usuario'))
                        <a href="{{route('dashboard')}}" class="d-block">{{auth()->user()->name}} {{auth()->user()->lastname}}</a>
                    @endif
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/dashboard") active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Inicio
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i class="fa fa-home nav-icon " aria-hidden="true"></i>
                            <p>
                                Inicio Bingo
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Accesos</li>
                    <li class="nav-item">
                        <a href="{{route('admin.templateconfigs.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/templateconfigs" ) active @endif">
                            <i class="nav-icon fa fa-users-cog"></i>
                            <p title="Administración de la aplición">
                                Adm. Aplicación
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.cardmains.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/cardmains" ) active @endif">
                            <i class="nav-icon fa fa-users-cog"></i>
                            <p title="Noticias Generales">
                                Noticias Generales
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.sponsors.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/sponsors" ) active @endif">
                            <i class="nav-icon fa fa-users-cog"></i>
                            <p title="Patrocinadores">
                                Patrocinadores
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.instructions.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/instructions" ) active @endif">
                            <i class="nav-icon fa fa-users-cog"></i>
                            <p title="Instrucciones">
                                Instrucciones
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.dynamicgames.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/dynamicgames" ) active @endif">
                            <i class="nav-icon fa fa-users-cog"></i>
                            <p title="Dinámica del Juego">
                                Dinámica del Juego
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.prizes.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/prizes" ) active @endif">
                            <i class="nav-icon fa fa-users-cog"></i>
                            <p title="Dinámica del Juego">
                                Premios
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                            <a href="{{route('admin.states.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/states") active @endif">
                                <i class="nav-icon fab fa-usps"></i>
                                <p>
                                    Estados
                                </p>
                            </a>
                    </li>

                    <li class="nav-item">
                            <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/roles") active @endif">
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>
                                    Roles
                                </p>
                            </a>
                    </li>
                    <li class="nav-item">
                            <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products" || $_SERVER['REQUEST_URI'] === "/admin/products/create") active @endif">
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>
                                    Patrocinadores
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products/create") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Productos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar Productos</p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                            <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products" || $_SERVER['REQUEST_URI'] === "/admin/products/create") active @endif">
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>
                                    Cartones
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products/create") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Productos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar Productos</p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                            <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products" || $_SERVER['REQUEST_URI'] === "/admin/products/create") active @endif">
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>
                                    usuarios
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products/create") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Productos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar Productos</p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                            <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products" || $_SERVER['REQUEST_URI'] === "/admin/products/create") active @endif">
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>
                                    Terminos y Condiciones
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products/create") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Productos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar Productos</p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <li class="nav-header ">Configuraciones</li>
                    <li class="nav-item" title="{{auth()->user()->email}}">
                        <a   class="nav-link disabled">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>{{auth()->user()->email}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a style="cursor: pointer;" onclick="document.getElementById('cerrar').submit()" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Cerrar Sesión</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!--main donde se encuenta nuestro contenido-->
    <main>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2023 <a href="https://uniandes.edu.co/">Universidad de los Andes</a>.</strong>
        Derechos Reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versión</b> 1.1.0
        </div>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{url('recursos/admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('recursos/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{url('recursos/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('recursos/admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{url('recursos/admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('recursos/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{url('recursos/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{url('recursos/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{url('recursos/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{url('recursos/admin/dist/js/adminlte.js')}}"></script>
<script src="{{url('recursos/admin/dist/js/demo.js')}}"></script>
<script src="{{url('recursos/admin/plugins/select2/js/select2.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    if (document.getElementsByClassName('glide')) {
      const glider = new Glide('.gliderrr', {
        autoplay: 10000,
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
