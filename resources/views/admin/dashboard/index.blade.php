@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Panel Administrativo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Panel Administrativo</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <style>
        .select2-container--default .select2-selection--single{
            height: 37px!important;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <h5 class="mb-2">Asignación o Modificación rápida de grupos de cartones por usuario:</h5>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 d-flex">
                        <select id="userSelect" class="form-control">
                            <option value=""></option> <!-- Agrega una opción en blanco -->
                            @foreach ($users as $user)
                                <option value="{{ route('admin.users.show', $user->id) }}">{{$user->email}} </option>
                            @endforeach
                        </select>
                        <button title="Buscar" id="goButton" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <h5 class="mb-2">Información general</h5>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-receipt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Cartones</span>
                            <span class="info-box-number">{{$allCardboard}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fa fa-layer-group"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Grupos de Cartones</span>
                            <span class="info-box-number">{{$allCartonGroup}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Usuarios</span>
                            <span class="info-box-number">{{$allUser}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-chart-pie"></i> Gráficas generales de ventas</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="cartonGrap"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <script>
        var ctx = document.getElementById('cartonGrap').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Cartones Creados', 'Cartones Vendidos'],
                datasets: [{
                    data: [{{ $allCardboard }}, {{ $caronesVendidos }}],
                    backgroundColor: [
                        'rgb(75, 192, 192)', // Color para Cartones Asignados
                        'rgb(255, 99, 132)'  // Color para Cartones Pendientes
                    ]
                }]
            },

        });
    </script>
    <script>
        $(document).ready(function() {
            // Inicializar el select2 con opciones mínimas
            $('#userSelect').select2({
                minimumInputLength: 1, // Comenzar la búsqueda después de ingresar al menos 1 carácter
                placeholder: "Buscar usuario..."
            });

            // Manejar el evento clic del botón "Ir"
            $('#goButton').on('click', function() {
                var selectedUrl = $('#userSelect').val(); // Obtener la URL seleccionada
                if (selectedUrl) {
                    window.location.href = selectedUrl; // Redireccionar al usuario seleccionado
                }
            });
        });
    </script>
@endsection
