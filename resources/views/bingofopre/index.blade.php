@extends('layouts.guest')
@section('title','Inicio')
@section('content')
    <section class="my-5 py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
                    <div class="rotating-card-container">
                        @foreach($templateconfigs as $templateconfig)
                            <div class="card card-rotate card-background card-background-mask-primary shadow-primary mt-md-0 mt-5">
                                <div class="front front-background"
                                     style="background-image: url({{asset('storage/'.$templateconfig->img_carton)}}); background-size: cover; width: 100%;">
                                    <div class="card-body py-7 text-center" >
                                        <i class="material-icons withe-special-lckm text-4xl my-3">touch_app</i>
                                        <h3 class="withe-special-lckm" >Bingo Fopre</h3>
                                    </div>
                                </div>
                                <div class="back back-background">
                                     {{-- 
                                        style="background-image: url({{asset('storage/'.$templateconfig->img_carton)}}); background-size: cover;"
                                        --}}
                                    <div class="card-body pt-7 text-center">
                                        <h3 class="withe-special-lckm">Bingo Fopre</h3>
                                            <h5 class="withe-special-lckm opacity-8"> Valor: $ {{number_format(intval($templateconfig->price_carton))}}</h5>
                                            <div class="withe-special-lckm opacity-8"> {!! $templateconfig->description_carton !!}</div>
                                            <a href="{{$templateconfig->url_carton}}" target="_blank"
                                                class="btn btn-white btn-sm w-50 mx-auto mt-3" style="width: 150px!important; margin-bottom: 40px;"><i class="material-icons opacity-6 me-2 text-md">add_shopping_cart</i> Comprar aquí</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-6 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
                    <div class="rotating-card-container">
                        @foreach($templateconfigs as $templateconfig)
                        <div class="card card-rotate card-background card-background-mask-primary shadow-primary mt-md-0 mt-5">
                            <div class="front front-background"
                                 style="background-image: url({{asset('storage/'.$templateconfig->img_live)}}); background-size: cover; width: 100%; height: 305px;">
                                <div class="card-body py-7 text-center">
                                    <i class="material-icons withe-special-lckm text-4xl my-3">touch_app</i>
                                    <h3 class="withe-special-lckm">Trasmición en <br /> Vivo</h3>
                                </div>
                            </div>
                            <div class="back back-background">
                                {{--style="background-image: url({{asset('storage/'.$templateconfig->img_live)}}); background-size: cover; height: 305px;"--}}
                                <div class="card-body pt-7 text-center">
                                    <h3 class="withe-special-lckm">Trasmición en Vivo</h3>
                                    <p class="withe-special-lckm opacity-8"> {{$templateconfig->description_live}}</p>
                                    <a href="{{$templateconfig->url_live}}" target="_blank"
                                       class="btn btn-white btn-sm w-50 mx-auto mt-3" style="width: 150px!important;"><i class="material-icons opacity-6 me-2 text-md">cast_connected</i> Conectarse</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                @foreach($cardmains as $index => $cardmain)
                    <hr class="horizontal dark my-5">
                    <div class="col-lg-12 mb-5">
                        <div class="row{{ ($index % 2 == 0) ? ' flex-row-reverse' : '' }}">
                            <div class="col-lg-6 justify-content-center d-flex flex-column">
                                <div class="card border-radius-lg">
                                    <div class="d-block blur-shadow-image">
                                        <img src="{{asset('storage/' . $cardmain->imagen)}}" alt="img-blur-shadow-blog-2" class="img-fluid border-radius-lg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 justify-content-center d-flex flex-column ps-lg-5 pt-lg-0 pt-3">
                                <h3 class="title-special-lckm">
                                    {{$cardmain->title}}
                                </h3>
                                <div class="p-special-lckm">
                                    {!! $cardmain->description !!}
                                </div>
                                
                                @if ($cardmain->mas_info)
                                    <p>
                                        <a href="{{$cardmain->mas_info}}" target="_blank" class="url-special-lckm icon-move-right text-sm">
                                            Más información.
                                            <i class="fas fa-arrow-right text-xs ms-1"></i>
                                        </a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </section>
    <section class="py-sm-7" id="pricing-soft-ui">
        <div class="mt-lg-n8 mt-n6">
            <div class="container">
                <h3 class="title-special-lckm mb-0 text-center">Con el partocinio de:</h3>
                <hr class="horizontal dark my-5">
                <div class="row">
                    @foreach($sponsors as $sponsor)
                        <div class="col-lg-2 col-md-4 col-6 mx-auto">
                            <img class="w-100 opacity-6" src="{{asset('storage/'. $sponsor->logo)}}" alt="{{$sponsor->name}}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
