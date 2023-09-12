@extends('layouts.guest')
@section('title','Instrucciones')
@section('content')
    <section class="testimonial-2 mt-5 pt-5">
        <div class="container">
            <div class="row mt-n5 border-radius-md pb-4 p-3 mx-sm-0 mx-1 position-relative z-index-3">
                <div class="col-lg-3 mt-lg-n2 mt-2">
                    <label class="ms-0">Leave From</label>
                    <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" name="choice-button" id="choice-button" hidden="" tabindex="-1" data-choice="active"><option value="Choice 1">Brazil</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="Choice 1" data-custom-properties="null" aria-selected="true">Brazil</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--choice-button-item-choice-1" class="choices__item choices__item--choice is-selected choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="Choice 1" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Brazil</div><div id="choices--choice-button-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Choice 2" data-select-text="Press to select" data-choice-selectable="">Bucharest</div><div id="choices--choice-button-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Choice 3" data-select-text="Press to select" data-choice-selectable="">London</div><div id="choices--choice-button-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Choice 4" data-select-text="Press to select" data-choice-selectable="">USA</div></div></div></div>
                </div>
                <div class="col-lg-3 mt-lg-n2 mt-2">
                    <label class="ms-0">To</label>
                    <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" name="choice-remove-button" id="choice-remove-button" hidden="" tabindex="-1" data-choice="active"><option value="Choice 1">Italy</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="Choice 1" data-custom-properties="null" aria-selected="true">Italy</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--choice-remove-button-item-choice-1" class="choices__item choices__item--choice choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="Choice 3" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Denmark</div><div id="choices--choice-remove-button-item-choice-2" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Choice 1" data-select-text="Press to select" data-choice-selectable="">Italy</div><div id="choices--choice-remove-button-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Choice 4" data-select-text="Press to select" data-choice-selectable="">Poland</div><div id="choices--choice-remove-button-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Choice 2" data-select-text="Press to select" data-choice-selectable="">Spain</div></div></div></div>
                </div>
                <div class="col-lg-3 mt-lg-n2 mt-2">
                    <label class="ms-0">Depart</label>
                    <div class="input-group input-group-static">
                        <span class="input-group-text"><i class="fas fa-calendar" aria-hidden="true"></i></span>
                        <input class="form-control datepicker" placeholder="Please select date" type="text">
                    </div>
                </div>
                <div class="col-lg-3 d-flex align-items-center my-auto">
                    <button type="button" class="btn bg-gradient-primary w-100 mb-0 m4 mt-3">Book</button>
                </div>
            </div>
            <div class="row mt-5">
                <div class="gliderrr glide--ltr glide--carousel glide--swipeable">
                    <div data-glide-el="track" class="glide__track">
                        <ul class="glide__slides" style="transition: transform 400ms cubic-bezier(0.165, 0.84, 0.44, 1) 0s; width: 3727.5px; transform: translate3d(-2300px, 0px, 0px);">
                            <li class="glide__slide glide__slide--clone" style="width: 277.5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-lg-n6 mt-n4 position-absolute" src="../assets/img/automotive/g-amg.png" alt="g-amg" loading="lazy">
                                            <h6 class="mt-6">G63 AMG</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li><li class="glide__slide glide__slide--clone" style="width: 277.5px; margin-left: 5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-lg-n6 mt-n4 position-absolute" src="../assets/img/automotive/s-maybach.png" alt="s-mayback" loading="lazy">
                                            <h6 class="mt-6">S Maybach</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li><li class="glide__slide glide__slide--clone" style="width: 277.5px; margin-left: 5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-lg-n6 mt-n4 position-absolute" src="../assets/img/automotive/glc.png" alt="glc" loading="lazy">
                                            <h6 class="mt-6">GLC</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li><li class="glide__slide glide__slide--clone" style="width: 277.5px; margin-left: 5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-n4 position-absolute" src="../assets/img/automotive/cls.png" alt="cls" loading="lazy">
                                            <h6 class="mt-6">CLS</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li><li class="glide__slide" style="width: 277.5px; margin-left: 5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-lg-n6 mt-n4 position-absolute" src="../assets/img/automotive/amg-gt.png" alt="amg-gt" loading="lazy">
                                            <h6 class="mt-6">AMG GT</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="glide__slide" style="width: 277.5px; margin-left: 5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-lg-n6 mt-n4 position-absolute" src="../assets/img/automotive/g-amg.png" alt="g-amg" loading="lazy">
                                            <h6 class="mt-6">G63 AMG</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="glide__slide" style="width: 277.5px; margin-left: 5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-lg-n6 mt-n4 position-absolute" src="../assets/img/automotive/s-maybach.png" alt="s-mayback" loading="lazy">
                                            <h6 class="mt-6">S Maybach</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="glide__slide" style="width: 277.5px; margin-left: 5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-lg-n6 mt-n4 position-absolute" src="../assets/img/automotive/glc.png" alt="glc" loading="lazy">
                                            <h6 class="mt-6">GLC</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="glide__slide glide__slide--active" style="width: 277.5px; margin-left: 5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-n4 position-absolute" src="../assets/img/automotive/cls.png" alt="cls" loading="lazy">
                                            <h6 class="mt-6">CLS</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="glide__slide glide__slide--clone" style="width: 277.5px; margin-left: 5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-lg-n6 mt-n4 position-absolute" src="../assets/img/automotive/amg-gt.png" alt="amg-gt" loading="lazy">
                                            <h6 class="mt-6">AMG GT</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li><li class="glide__slide glide__slide--clone" style="width: 277.5px; margin-left: 5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-lg-n6 mt-n4 position-absolute" src="../assets/img/automotive/g-amg.png" alt="g-amg" loading="lazy">
                                            <h6 class="mt-6">G63 AMG</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li><li class="glide__slide glide__slide--clone" style="width: 277.5px; margin-left: 5px; margin-right: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-lg-n6 mt-n4 position-absolute" src="../assets/img/automotive/s-maybach.png" alt="s-mayback" loading="lazy">
                                            <h6 class="mt-6">S Maybach</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li><li class="glide__slide glide__slide--clone" style="width: 277.5px; margin-left: 5px;">
                                <div class="glide__container">
                                    <div class="card">
                                        <div class="card-body text-center pb-0 position-relative">
                                            <img class="w-75 end-0 start-0 mx-auto top-0 mt-lg-n6 mt-n4 position-absolute" src="../assets/img/automotive/glc.png" alt="glc" loading="lazy">
                                            <h6 class="mt-6">GLC</h6>
                                            <button type="button" class="btn btn-sm btn-rounded btn-outline-dark">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </li></ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-4">
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

            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="accordion" id="accordionRental">
                        <div class="accordion-item mb-3">
                            @foreach($instructions as $instruction)
                            <h5 class="accordion-header" id="headingOne">
                                <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
                            <h5 class="accordion-header" id="headingTwo">
                                <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
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
