@extends('site.layouts.app')
@section('title' , trans('site.products'))
@section('content')
<section class="products mt-5">
    <div class="container">
        <div class="row">
            @if($categories->count())
            <!-- .product-filters -->
            <div class="col-12 col-md-3">
                @include('site.partials.products.main.filter')
            </div>
            <!-- ./product-filters -->
            @endif

            @if($products->count())
            <div class="col-12 col-md-9">
                <div class="row">
                    @foreach ($products as $product)
                    <!-- .product-card -->
                    <div class="col-12 col-md-4">
                        <div class="product-card">
                            @if($product->hasDiscount())
                            <span class="has-offer">
                                {{ trans('site.discount.percent' , ['discount' => $product->discount_percent]) }}
                            </span>
                            @endif
                            <a href="{{ route('product.show' , $product) }}">
                                <img src="{{ $product->firstImage() }}" alt="dummy">
                                <h3>
                                    {{ $product->title }}
                                </h3>
                            </a>
                            <h6 class="price">
                                {{ $product->price }}
                            </h6>
                            <div class="btn-group-sm" role="group" aria-label="">
                                <button type="button" class="btn btn-sm btn-info rounded-pill"
                                    onclick="location.replace('{{ route('product.show' , $product) }}')">
                                    <i class="fas fa-shopping-cart"></i> {{ trans('site.buy') }}
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info rounded-pill"
                                    onclick="location.replace('{{ route('product.show' , $product) }}')">
                                    <i class="fas fa-eye mr-1"></i> {{ trans('site.view') }}
                                </button>
                                @auth
                                @role('user')
                                @livewire('site.wishlist-heart', ['product' => $product])
                                @endrole
                                @endauth
                            </div>

                        </div>
                    </div>
                    <!-- ./product-card -->
                    @endforeach
                </div>
                {{ $products->render() }}
            </div>
            @else
            <div class="col-lg-12">
                <h3 class="text-center">
                    {{ trans('site.no_products_exist') }}
                </h3>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
