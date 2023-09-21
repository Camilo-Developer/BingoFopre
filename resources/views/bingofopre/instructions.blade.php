@extends('layouts.app2')
@section('title','Instrucciones')
@section('contents')
    <style>
        .img-cards-scroll{
            width: 150px!important;
            position: absolute;
            margin-left: -85px;
            margin-top: -90px;

        }
    </style>
    <section class="testimonial-2 mt-2 pt-2">
        <div class="row flex-lg-row-reverse">
            <div class="col-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('bingofopre.index')}}">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Instrucciones</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container">
            <div class="row mt-2">
                <div class="gliderrr">
                    <div data-glide-el="track" class="glide__track">
                        <ul class="glide__slides">

                            <li class="glide__slide" style="min-height: 365px!important;">
                                <div class="glide__container"  style="min-height: 365px!important;">
                                    <div class="card" style="min-height: 365px!important;">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <h6 class="mt-6">Dinamica del Juego</h6>
                                            <p class="mb-6">Se jugarán {{$dynamicgamescount}} juegos de Bingo. <br>
                                                Cada juego se debe llenar de la siguiente forma</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @php
                                $nombreFila = [
                                    1 => 'No aplica.',
                                    2 => 'Primera fila.',
                                    3 => 'Segunda fila.',
                                    4 => 'Tercera fila.',
                                    5 => 'Cuarta fila.',
                                    6 => 'Quinta fila.',
                                    7 => 'Completo.',
                                ];
                                $nombreColum = [
                                    1 => 'No aplica.',
                                    2 => 'Primera columna.',
                                    3 => 'Segunda columna.',
                                    4 => 'Tercera columna.',
                                    5 => 'Cuarta columna.',
                                    6 => 'Quinta columna.',
                                    7 => 'Completo.',
                                ];
                            @endphp

                            @foreach($dynamicgames as $dynamicgame)
                                @php
                                    $filaArray = json_decode($dynamicgame->fila, true);
                                    $filaArrayColum = json_decode($dynamicgame->colum, true);
                                @endphp
                                <li class="glide__slide" style="min-width: 330px!important; min-height: 365px!important;">
                                    <div class="glide__container" style="min-height: 365px!important;">
                                        <div class="card" style="min-height: 365px!important;">
                                            <div class="card-body text-center pb-0 position-relative">
                                                <img  class="  img-cards-scroll"
                                                     src="{{ asset('storage/' . $dynamicgame->logo) }}">
                                                <h6 class="mt-6">{{ ucwords($dynamicgame->title) }}</h6>
                                                <h6 class="">Letra: {{ strtoupper($dynamicgame->letra) }}</h6>
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        @if(is_array($filaArray))
                                                            @foreach($filaArray as $numero)
                                                                <div class="p-3 d-flex px-0 py-1">
                                                                    <div class="ps-3">
                                                                        <span class="text-sm font-weight-bold">{{ $nombreFila[$numero] }}</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="col-6">
                                                        @if(is_array($filaArrayColum))
                                                            @foreach($filaArrayColum as $numeros)
                                                                <div class="p-3 d-flex px-0 py-1">
                                                                    <div class="ps-3">
                                                                        <span class="text-sm font-weight-bold">{{ $nombreColum[$numeros] }}</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach






                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-4">

        <div class="container">

            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="accordion" id="accordionRental">
                        <div class="accordion-item mb-3">
                            @foreach($instructions as $instruction)
                            <h5 class="accordion-header" id="headingOne">
                                <button class="accordion-button border-bottom font-weight-bold withe-special-lckm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Instrucciones
                                    <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0"></i>
                                    <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0"></i>
                                </button>
                            </h5>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionRental">
                                <div class="accordion-body text-sm opacity-8">
                                    {!! $instruction->description_one !!}

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="accordion-item mb-3">
                            <h5 class="accordion-header withe-special-lckm" id="headingTwo">
                                <button class="accordion-button withe-special-lckm border-bottom font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Cómo cantar ¡BINGO FOPRE!
                                    <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0"></i>
                                    <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0"></i>
                                </button>
                            </h5>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionRental">
                                <div class="accordion-body text-sm opacity-8">
                                    {!! $instruction->description_two !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
