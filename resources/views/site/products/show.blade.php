@extends('site.layouts.app')
@section('title' , $product->title)
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
