@extends('dashboard.layouts.template')
@section('content')

<div class="panel mb-2">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="swiper pagination-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="assets/images/slider-4.jpg" alt="image">
                        </div>
                        <div class="swiper-slide">
                            <img src="assets/images/slider-5.jpg" alt="image">
                        </div>
                        <div class="swiper-slide">
                            <img src="assets/images/slider-6.jpg" alt="image">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-body">
        <div class="d-flex justify-content-start flex-wrap mb-2">
            @foreach ($kategori as $item)
                <button class="btn btn-sm btn-outline-primary mt-2 me-2" id="nav-topup-tab" data-bs-toggle="tab" data-bs-target="#nav-topup" type="button" role="tab" aria-controls="nav-topup" aria-selected="true">{{ $item }}</button>
            @endforeach
        </div>
        <hr>

        <div class="tab-content">
            <div class="tab-pane active" id="topup">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-img-top pt-3 px-3">
                                    <img src="{{ asset('assets/images/products/topup/icon-ml-gif.gif') }}" class="rounded-2" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <h6>Mobile Legends</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection