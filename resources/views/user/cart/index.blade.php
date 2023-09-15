@extends('layouts.guest')
@section('title','Carrtio Compra')
@section('content')
    <div class="container">
        <h1>Carrito de Compras</h1>
        <form action="{{ route('admin.cartones.finishPurchase') }}" method="POST">
            @csrf
            <label for="document_number">Documento de Identidad del Comprador:</label>
            <input type="text" name="document_number" id="document_number" required>


            <table class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Fecha de Finalización</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cart as $cartonId => $carton)
                    <tr  class="{{ $carton['state_id'] == 6 ? 'obsequio' : '' }}">
                        <td>{{ $carton['name'] }}</td>
                        <td>{{ $carton['quantity'] }}</td>
                        <td>$ {{ number_format(intval($carton['price'])) }}</td>
                        <td>{{ $carton['date_finish'] }}</td>
                        <td>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" value="5" type="radio" name="cartons[{{ $cartonId }}][state_id]" {{ $carton['state_id'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label">Vendido</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="6" type="radio" name="cartons[{{ $cartonId }}][state_id]" {{ $carton['state_id'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label">Obsequio</label>
                                </div>
                            </div>
                        </td>
                        <td><a onclick="document.getElementById('eliminar_carton').submit()" class="btn btn-danger">Eliminar</a></td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <div>
                <strong>Total a Pagar:</strong> <span id="total-to-pay">$ 0</span>
            </div>
            <button type="submit" class="btn btn-primary">Finalizar Compra</button>
        </form>

        @foreach($cart as $cartonId => $carton)
            <form action="{{ route('admin.cartones.removeFromCart', $cartonId) }}" method="POST" id="eliminar_carton">
                @csrf
                @method('DELETE')
            </form>
        @endforeach


    </div>

    <script src="{{url('recursos/admin/plugins/jquery/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            function calcularTotal() {
                let totalToPay = 0;
                $('tbody tr:not(.obsequio)').each(function() {
                    const isChecked = $(this).find('input[type="radio"][value="5"]').prop('checked');
                    if (isChecked) {
                        const price = parseFloat($(this).find('td:nth-child(3)').text().replace('$', '').replace(',', ''));
                        totalToPay += price;
                    }
                });

                // Formatear el total sin decimales, sin punto y con el símbolo "$"
                const formattedTotal = '$ ' + totalToPay.toLocaleString('en-US').split('.')[0];

                $('#total-to-pay').text(formattedTotal);
            }
            calcularTotal();

            // Agrega un evento para calcular el total cuando cambie la selección de estado
            $('input[type="radio"]').on('change', calcularTotal);
        });
    </script>
@endsection
