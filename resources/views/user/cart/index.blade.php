@extends('layouts.guest')
@section('title','Carrtio Compra')
@section('content')
    <div class="container">
        <h1>Carrito de Compras</h1>
        <div class="row">
            <div class="col-12">
                <form action="{{route('user.cart.index')}}" method="GET">
                    <label for="document_number">Documento o correo del comprador:</label>
                    <div class="row">
                        <div class="col-9">
                            <input class="form-control"  type="text" name="document_number" value="{{ $userData->N_mero_de_Identificaci_n__c }}" id="document_number" required>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn  btn-success">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>




        <form action="{{ route('admin.cartones.finishPurchase') }}" method="POST">
            <div class="form-group">
                <div class="row  py-2">
                    <div class="col-lg-4 ">
                        <div>
                            <label>Categoria Principal</label>
                            <input  value="{{ $userData->Categoria_Principal__c }}" class="form-control"   placeholder="Nombre" type="text" >
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div>
                            <label>Categoria </label>
                            <input  value="{{ $userData->Categoria__c }}" class="form-control"   placeholder="Nombre" type="text" >
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div>
                            <label>Categoria Administrativa</label>
                            <input  value="{{ $userData->Categoria_Administrativo__c }}" class="form-control"   placeholder="Nombre" type="text" >
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div>
                            <label>Nombres del Comprador</label>
                            <input  value="{{ $userData->FirstName }} {{ $userData->LastName }}" class="form-control"   placeholder="Nombre" type="text" >
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div>
                            <label>Correo del Comprador</label>
                            <input  value="{{ $userData->Email }}" class="form-control"   placeholder="Correo" type="text" >
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div>
                            <label>Genero email</label>
                            <input  value="{{ $userData->generoEmail__c }}" class="form-control"   placeholder="Correo" type="text" >
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div>
                            <label>Tipo de documento</label>
                            <input  value="{{ $userData->Tipo_identificaci_n__c }}" class="form-control"   placeholder="Correo" type="text" >
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div>
                            <label>Numero de documento</label>
                            <input  value="{{ $userData->N_mero_de_Identificaci_n__c }}" class="form-control"   placeholder="Correo" type="text" >
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div>
                            <label>Numero de documento</label>
                            <input  value="{{ $userData->Tel_fono_celular_1__c }}" class="form-control"   placeholder="Correo" type="text" >
                        </div>
                    </div>
                </div>
            </div>




            @csrf
            <table class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
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
                        <td>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" value="5" type="radio" name="cartons[{{ $cartonId }}][state_id]" {{ $carton['state_id'] == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label">Vendido</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="6" type="radio" name="cartons[{{ $cartonId }}][state_id]" {{ $carton['state_id'] == 6 ? 'checked' : '' }}>
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
