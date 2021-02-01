<!-- Start Home page slider -->
<section class="twoipi-top-selling-items mt-5">
    <div class="container">
        <h2 class="font-weight-bold main-color text-uppercase text-center">
            {{ trans('site.related_products') }}
        </h2>
        <div class="owl-carousel owl-theme top-seller-carousel">
            @foreach ($related as $p)
            @include('site.partials.products.slider_item' , ['product' => $p])
            @endforeach
        </div>
    </div>
</section>
<!-- End Home page slider -->
