<div class="owl-carousel owl-theme top-seller-carousel">
    @foreach ($items as $item)
    @if($product = $item->product)
    <!-- .carousel-item -->
    <div class="item">
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
            {{ $product->price}}
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
    @endif
    <!-- ./carousel-item -->
    @endforeach
</div>
