@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Carrito de Compras</h1>
        <form action="{{ route('cartones.finishPurchase') }}" method="POST">
            @csrf

            <table class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Fecha de Finalización</th>
                    <th>Estado</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cart as $cartonId => $carton)
                    <tr>
                        <td>{{ $carton['name'] }}</td>
                        <td>{{ $carton['quantity'] }}</td>
                        <td>{{ $carton['date_finish'] }}</td>
                        <td><input type="text" name="cartons[{{ $cartonId }}][state_id]" value="{{ $carton['state_id'] }}"></td>
                        <td><input type="text" name="cartons[{{ $cartonId }}][user_id]" value="{{ $carton['user_id'] }}"></td>
                        <td><a onclick="document.getElementById('eliminar_carton').submit()" class="btn btn-danger">Eliminar</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Finalizar Compra</button>
        </form>

        @foreach($cart as $cartonId => $carton)
            <form action="{{ route('cartones.removeFromCart', $cartonId) }}" method="POST" id="eliminar_carton">
                @csrf
                @method('DELETE')
            </form>
        @endforeach


    </div>
@endsection
