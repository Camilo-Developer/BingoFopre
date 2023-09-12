@extends('layouts.app') <!-- Asegúrate de que esta línea coincida con tu diseño de plantilla -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear Cartones y Grupos de Forma Masiva</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('cartones.create') }}">
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
                                <label for="date">date</label>
                                <input type="date" id="date" name="date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="group_size">Tamaño del Grupo</label>
                                <input type="number" id="group_size" name="group_size" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Crear Cartones y Grupos</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
