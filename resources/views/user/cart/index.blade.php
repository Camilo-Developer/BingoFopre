@extends('layouts.guest')
@section('title','Carrtio Compra')
@section('content')
    <div class="container">
        <h1>Carrito de Compras</h1>
        <div class="row">
            <div class="col-12">
                <!--Primer formulario-->
                <form id="search-form">
                    @csrf
                    <label for="search2">Documento o correo del comprador:</label>
                    <div class="row">
                        <div class="col-7 col-lg-9">
                            <input class="form-control" type="text" name="search2" value="{{ $userData->N_mero_de_Identificaci_n__c ?? ''}}" id="search2" required>
                        </div>
                        <div class="col-5 col-lg-3">
                            <button type="button" id="search-button" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                </form>
                <!-- Campo oculto para almacenar la información -->
                <input type="hidden" id="userData">
                <!-- Agrega un div para mostrar la información consultada -->
                <div id="user-info"></div>
            </div>
        </div>



        <!--Segundo formulario-->

        <form action="{{ route('admin.cartones.finishPurchase') }}" method="POST">
            <input  name="Categoria_Principal__c"  type="hidden" >
            <input   name="Categoria__c"   type="hidden" >
            <input   name="Categoria_Administrativo__c"  type="hidden" >
            <input type="hidden"  name="FirstName" >
            <input type="hidden"  name="LastName" >
            <input   name="generoEmail__c"  type="hidden" >
            <input   name="Tipo_identificaci_n__c"  type="hidden" >
            <input   name="document_number"  type="hidden" >
            <input  name="Tel_fono_celular_1__c"   type="hidden" >
            <input  name="Email"   type="hidden" >

            <div class="form-group">
                <div class="row  py-2">
                    <div class="col-lg-6 ">
                        <div>
                            <label>Nombre del Comprador</label>
                            <input disabled  name="FirstName" class="form-control"   placeholder="Nombre" type="text" >
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div>
                            <label>Correo del Comprador</label>
                            <input disabled  name="Email" class="form-control"   placeholder="Correo eléctronico" type="text" >
                        </div>
                    </div>
                </div>
            </div>


            <div id="loading-alert" class="alert alert-info" style="display: none;">
                <span class="text-white">Buscando usuario comprador...</span>
            </div>

            <div id="not-found-alert" class="alert alert-danger" style="display: none;">
                <span class="text-white">No se encontró al usuario. Por favor, vuelve a intentarlo.</span>
            </div>


            @csrf
            <div class="table-responsive">
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
            </div>
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

    <script>
        $(document).ready(function() {
            function performAjaxRequest() {
                // Oculta las alertas existentes
                $("#loading-alert").hide();
                $("#not-found-alert").hide();

                // Muestra la alerta de "Buscando usuario comprador"
                $("#loading-alert").show();

                $.ajax({
                    url: "{{ route('user.cart.prueba') }}",
                    method: "GET",
                    data: $("#search-form").serialize(),
                    success: function(response) {
                        try {
                            const userData = JSON.parse(response);

                            // Rellenar los campos del formulario con los datos de Salesforce
                            $("input[name='Categoria_Principal__c']").val(userData.Categoria_Principal__c);
                            $("input[name='Categoria__c']").val(userData.Categoria__c);
                            $("input[name='Categoria_Administrativo__c']").val(userData.Categoria_Administrativo__c);
                            $("input[name='FirstName']").val(userData.FirstName);
                            $("input[name='LastName']").val(userData.LastName);
                            $("input[name='Email']").val(userData.Email);
                            $("input[name='generoEmail__c']").val(userData.generoEmail__c);
                            $("input[name='Tipo_identificaci_n__c']").val(userData.Tipo_identificaci_n__c);
                            $("input[name='Tel_fono_celular_1__c']").val(userData.Tel_fono_celular_1__c);
                            $("input[name='document_number']").val(userData.N_mero_de_Identificaci_n__c);

                            // Oculta la alerta una vez que se encuentre el usuario
                            $("#loading-alert").hide();
                        } catch (error) {
                            // Oculta la alerta de "Buscando usuario comprador"
                            $("#loading-alert").hide();
                            // Muestra la alerta de "Usuario no encontrado"
                            $("#not-found-alert").show();
                        }
                    },
                    error: function(xhr, textStatus, error) {
                        // Manejar errores de la solicitud AJAX aquí si es necesario
                        console.error("Error en la solicitud AJAX:", error);

                        // Oculta la alerta de "Buscando usuario comprador"
                        $("#loading-alert").hide();
                    }
                });
            }


            $("#search-button").on("click", function() {
                performAjaxRequest();
            });

            $("#search-form").submit(function(e) {
                e.preventDefault();
            });
        });
    </script>


@endsection
