@extends('layouts.app')
@section('title','Creación de Cartones Masivos')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Creación de Cartones Masivos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Creación de Cartones Masivos</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid" >
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.cartones.create') }}">
                        @csrf

                        <div class="form-group">
                            <label for="start_number">Número de Inicio</label>
                            <input type="number" id="start_number" name="start_number" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="end_number">Número Final</label>
                            <input type="number" id="end_number" name="end_number" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="group_size">Tamaño del Grupo</label>
                            <input type="number" id="group_size" name="group_size" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" id="price" name="price" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Crear Cartones y Grupos</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>



@endsection
