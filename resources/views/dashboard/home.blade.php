@extends('layouts.template')
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
        <div class="btn-box d-flex flex-wrap gap-1" id="nav-tab" role="tablist">
            @foreach ($kategori as $key => $item)
                <button class="btn btn-sm btn-outline-primary mt-1 me-1 {{ ($key == 0) ? "active" : "" }}" data-bs-toggle="tab" data-bs-target="#{{ $item['kt_code'] }}" type="button" role="tab" aria-controls="nav-{{ $item['kt_code'] }}">{{ ucfirst(strtolower($item['kt_name'])) }}</button>
            @endforeach
        </div>
        <hr>

        <div class="tab-content">
            @foreach ($kategori as $key => $item)
                <div class="tab-pane fade {{ ($key == 0) ? "active show" : "" }}" id="{{ $item['kt_code'] }}">
                    <div class="row">
                        @foreach ($item['providers'] as $provider)
                            <div class="col-md-2">
                                <div class="card h-100 border-light">
                                    <a href="javascript:void(0)" class="text-light">
                                        <div class="card-img-top pt-3 px-3">
                                            <img src="{{ Storage::url($provider['pv_image']) }}" class="rounded-2" alt="">
                                        </div>
                                        <div class="card-body text-center">
                                            <h6>{{ $provider['pv_code'] }}</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection