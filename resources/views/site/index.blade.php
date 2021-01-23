@extends('site.layouts.app')

@section('content')
<!-- Start Home page slider -->
<section class="twoipi-slider mt-5">
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/slider/1.png" class="d-block w-100" alt="twoipi-slider-photo">
                </div>
                <div class="carousel-item">
                    <img src="img/slider/1.png" class="d-block w-100" alt="twoipi-slider-photo">
                </div>
                <div class="carousel-item">
                    <img src="img/slider/1.png" class="d-block w-100" alt="twoipi-slider-photo">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Home page slider -->

<!-- Start twoipi-services  -->
<section class="twoipi-services mt-5">
    <div class="container">
        <div class="row">
            <!-- .col-6 -->
            <div class="col-12 col-md-6">
                <div class="service-box text-center border border-primary p-4">
                    <i class="fas fa-headset"></i>
                    <h4 class="font-weight-bold main-color">
                        {{ trans('site.services.sec1.title') }}
                    </h4>
                    <p class="mb-0">
                        {{ trans('site.services.sec1.description') }}
                    </p>
                </div>
            </div>
            <!-- ./col-6 -->
            <!-- .col-6 -->
            <div class="col-12 col-md-6">
                <div class="service-box text-center border border-primary p-4">
                    <i class="fas fa-paint-brush"></i>
                    <h4 class="font-weight-bold main-color">
                        {{ trans('site.services.sec2.title') }}
                    </h4>
                    <p class="mb-0">
                        {{ trans('site.services.sec2.description') }}
                    </p>
                </div>
            </div>
            <!-- ./col-6 -->
            <!-- .col-6 -->
            <div class="col-12 col-md-6">
                <div class="service-box text-center border border-primary p-4">
                    <i class="fas fa-truck"></i>
                    <h4 class="font-weight-bold main-color">
                        {{ trans('site.services.sec3.title') }}
                    </h4>
                    <p class="mb-0">
                        {{ trans('site.services.sec3.description') }}
                    </p>
                </div>
            </div>
            <!-- ./col-6 -->
            <!-- .col-6 -->
            <div class="col-12 col-md-6">
                <div class="service-box text-center border border-primary p-4">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h4 class="font-weight-bold main-color">
                        {{ trans('site.services.sec4.title') }}
                    </h4>
                    <p class="mb-0">
                        {{ trans('site.services.sec4.description') }}
                    </p>
                </div>
            </div>
            <!-- ./col-6 -->

        </div>
    </div>
</section>
<!-- End twoipi-services  -->

<!-- Start Home page slider -->
<section class="twoipi-customer-rate">
    <div class="container">
        <ul class="list-unstyled">
            <li class="mb-3">
                <img class="w-100" src="{{ asset('img/customer-rate/1.png') }}" alt="customer-rate">
            </li>
            <li class="mb-3">
                <img class="w-100" src="{{ asset('img/customer-rate/2.png') }}" alt="customer-rate">
            </li>
        </ul>
    </div>
</section>
<!-- End Home page slider -->

<!-- Start Home page slider -->
<section class="twoipi-top-selling-items mt-5">
    <div class="container">
        <h2 class="font-weight-bold main-color text-uppercase text-center">
            top selling items (party supplies)
        </h2>
        <div class="owl-carousel owl-theme top-seller-carousel">
            <!-- .carousel-item -->
            <div class="item">
                <span class="has-offer">
                    -25% off
                </span>
                <a href="#">
                    <img src="img/top-seller/01.png" alt="dummy">
                    <h3>
                        Mickey and Minnie mouse cupcake topper and wrapper
                    </h3>
                </a>
                <h6 class="price">
                    EGP 5.00
                </h6>
                <div class="btn-group-sm" role="group" aria-label="">
                    <button type="button" class="btn btn-sm btn-info rounded-pill">
                        <i class="fas fa-shopping-cart"></i> Buy
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button type="button" class="btn-add-to-favorite">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
            <!-- ./carousel-item -->
            <!-- .carousel-item -->
            <div class="item">
                <span class="has-offer">
                    -25% off
                </span>
                <a href="#">
                    <img src="img/top-seller/01.png" alt="dummy">
                    <h3>
                        Mickey and Minnie mouse cupcake topper and wrapper
                    </h3>
                </a>
                <h6 class="price">
                    EGP 5.00
                </h6>
                <div class="btn-group-sm" role="group" aria-label="">
                    <button type="button" class="btn btn-sm btn-info rounded-pill">
                        <i class="fas fa-shopping-cart"></i> Buy
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button type="button" class="btn-add-to-favorite">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
            <!-- ./carousel-item -->
            <!-- .carousel-item -->
            <div class="item">
                <span class="has-offer">
                    -25% off
                </span>
                <a href="#">
                    <img src="img/top-seller/01.png" alt="dummy">
                    <h3>
                        Mickey and Minnie mouse cupcake topper and wrapper
                    </h3>
                </a>
                <h6 class="price">
                    EGP 5.00
                </h6>
                <div class="btn-group-sm" role="group" aria-label="">
                    <button type="button" class="btn btn-sm btn-info rounded-pill">
                        <i class="fas fa-shopping-cart"></i> Buy
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button type="button" class="btn-add-to-favorite">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
            <!-- ./carousel-item -->
            <!-- .carousel-item -->
            <div class="item">
                <span class="has-offer">
                    -25% off
                </span>
                <a href="#">
                    <img src="img/top-seller/01.png" alt="dummy">
                    <h3>
                        Mickey and Minnie mouse cupcake topper and wrapper
                    </h3>
                </a>
                <h6 class="price">
                    EGP 5.00
                </h6>
                <div class="btn-group-sm" role="group" aria-label="">
                    <button type="button" class="btn btn-sm btn-info rounded-pill">
                        <i class="fas fa-shopping-cart"></i> Buy
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button type="button" class="btn-add-to-favorite">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
            <!-- ./carousel-item -->
            <!-- .carousel-item -->
            <div class="item">
                <span class="has-offer">
                    -25% off
                </span>
                <a href="#">
                    <img src="img/top-seller/01.png" alt="dummy">
                    <h3>
                        Mickey and Minnie mouse cupcake topper and wrapper
                    </h3>
                </a>
                <h6 class="price">
                    EGP 5.00
                </h6>
                <div class="btn-group-sm" role="group" aria-label="">
                    <button type="button" class="btn btn-sm btn-info rounded-pill">
                        <i class="fas fa-shopping-cart"></i> Buy
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button type="button" class="btn-add-to-favorite">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
            <!-- ./carousel-item -->

        </div>
    </div>
</section>
<!-- End Home page slider -->

<!-- Start Home page slider -->
<section class="twoipi-top-selling-items mt-5">
    <div class="container">
        <h2 class="font-weight-bold main-color text-uppercase text-center">
            top selling items (cake tools)
        </h2>
        <div class="owl-carousel owl-theme top-seller-carousel">
            <!-- .carousel-item -->
            <div class="item">
                <span class="has-offer">
                    -25% off
                </span>
                <a href="#">
                    <img src="img/top-seller/01.png" alt="dummy">
                    <h3>
                        Mickey and Minnie mouse cupcake topper and wrapper
                    </h3>
                </a>
                <h6 class="price">
                    EGP 5.00
                </h6>
                <div class="btn-group-sm" role="group" aria-label="">
                    <button type="button" class="btn btn-sm btn-info rounded-pill">
                        <i class="fas fa-shopping-cart"></i> Buy
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button type="button" class="btn-add-to-favorite">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
            <!-- ./carousel-item -->
            <!-- .carousel-item -->
            <div class="item">
                <span class="has-offer">
                    -25% off
                </span>
                <a href="#">
                    <img src="img/top-seller/01.png" alt="dummy">
                    <h3>
                        Mickey and Minnie mouse cupcake topper and wrapper
                    </h3>
                </a>
                <h6 class="price">
                    EGP 5.00
                </h6>
                <div class="btn-group-sm" role="group" aria-label="">
                    <button type="button" class="btn btn-sm btn-info rounded-pill">
                        <i class="fas fa-shopping-cart"></i> Buy
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button type="button" class="btn-add-to-favorite">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
            <!-- ./carousel-item -->
            <!-- .carousel-item -->
            <div class="item">
                <span class="has-offer">
                    -25% off
                </span>
                <a href="#">
                    <img src="img/top-seller/01.png" alt="dummy">
                    <h3>
                        Mickey and Minnie mouse cupcake topper and wrapper
                    </h3>
                </a>
                <h6 class="price">
                    EGP 5.00
                </h6>
                <div class="btn-group-sm" role="group" aria-label="">
                    <button type="button" class="btn btn-sm btn-info rounded-pill">
                        <i class="fas fa-shopping-cart"></i> Buy
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button type="button" class="btn-add-to-favorite">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
            <!-- ./carousel-item -->
            <!-- .carousel-item -->
            <div class="item">
                <span class="has-offer">
                    -25% off
                </span>
                <a href="#">
                    <img src="img/top-seller/01.png" alt="dummy">
                    <h3>
                        Mickey and Minnie mouse cupcake topper and wrapper
                    </h3>
                </a>
                <h6 class="price">
                    EGP 5.00
                </h6>
                <div class="btn-group-sm" role="group" aria-label="">
                    <button type="button" class="btn btn-sm btn-info rounded-pill">
                        <i class="fas fa-shopping-cart"></i> Buy
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button type="button" class="btn-add-to-favorite">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
            <!-- ./carousel-item -->
            <!-- .carousel-item -->
            <div class="item">
                <span class="has-offer">
                    -25% off
                </span>
                <a href="#">
                    <img src="img/top-seller/01.png" alt="dummy">
                    <h3>
                        Mickey and Minnie mouse cupcake topper and wrapper
                    </h3>
                </a>
                <h6 class="price">
                    EGP 5.00
                </h6>
                <div class="btn-group-sm" role="group" aria-label="">
                    <button type="button" class="btn btn-sm btn-info rounded-pill">
                        <i class="fas fa-shopping-cart"></i> Buy
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button type="button" class="btn-add-to-favorite">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
            <!-- ./carousel-item -->

        </div>
    </div>
</section>
<!-- End Home page slider -->

@endsection
