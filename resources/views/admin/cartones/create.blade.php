@extends('layouts.app')
@section('title','Cartones')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear Cartones y Grupos de Forma Masiva</div>
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
                                <label for="date">date</label>
                                <input type="date" id="date" name="date" class="form-control" required>
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

                        <div class="row">


                                <br><br>

                        @foreach($cartones as $carton)
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>Carton</p>
                                            <p>Nombre:{{$carton->name}}</p>
                                            <p>estado:{{$carton->state->name}}</p>
                                            <p>Precio:{{$carton->price}}</p>
                                            <p>gurpo:{{$carton->group_id}}</p>
                                            <a href="{{url('admin/add-to-cart/'.$carton->id)}}" class="btn btn-primary">Agregar carro</a>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
