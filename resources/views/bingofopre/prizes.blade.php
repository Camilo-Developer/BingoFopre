@extends('layouts.app2')
@section('title', 'Premios')
@section('contents')
    <section class="py-3">
        <div class=" m-3 border-radius-xl">
            <div class="container pb-lg-9 pb-10 pt-1 postion-relative z-index-2">
            </div>
        </div>
        <div class="mt-n10">
            <div class="container">
                <div class="tab-content tab-space">
                    <div class="tab-pane active" id="monthly">
                        <div class="row">
                            @foreach($prizes as $prize)
                                <div class="col-lg-4 mb-lg-0 mb-4 pb-5">
                                    <div class="card  shadow-lg" style="background-color: {{$prize->color}}">
                                        <span class="badge rounded-pill bg-light text-dark w-30 mt-n2 mx-auto">Premio</span>
                                        <div class="card-header text-center pt-4 pb-3 bg-transparent">
                                            <img width="130px" src="{{'storage/'. $prize->imagen}}" alt="premio">
                                        </div>
                                        <div class="card-body text-lg-start text-center pt-0">
                                            {!! $prize->description !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
