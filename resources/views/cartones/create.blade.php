<!-- resources/views/cartones/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crear Cartones Masivos</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('cartones.create') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="start_number">Número de inicio:</label>
                <input type="number" name="start_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_number">Número de fin:</label>
                <input type="number" name="end_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha_finalizacion">Fecha de Finalización:</label>
                <input type="date" name="date_finish" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Cartones</button>
        </form>
    </div>
@endsection
