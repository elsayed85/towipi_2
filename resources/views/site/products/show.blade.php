@extends('site.layouts.app')
@section('title' , $product->title)
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endsection
@section('content')
<section class="product-view mt-5">
    <div class="container">
        <div class="row">
            <!-- .product-view-gallery -->
            <div class="col-12 col-md-6">
                @if($product->images()->count())
                @include('site.partials.products.images_slider')
                @endif
                @if($product->video_url)
                @include('site.partials.products.video')
                @endif
                @include('site.partials.products.reviews')
                @include('site.partials.products.reviews_list')
            </div>
            <!-- ./product-view-gallery -->
            <!-- .product-view-gallery -->
            <div class="col-12 col-md-6">
                @include('site.partials.products.info')
            </div>
            <!-- ./product-view-gallery -->
        </div>
    </div>
</section>
@if($related->count())
@include('site.partials.products.related')
@endif
@endsection
@section('js')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $('select').selectpicker();
</script>
@endsection
