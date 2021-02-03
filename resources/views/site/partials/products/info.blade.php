@php
$inStock = $product->inStock();
@endphp
<div class="product-details">
    <h1>
        {{ $product->title }}
    </h1>
    <h2>
        {{ $product->price }}
        @if($product->hasDiscount())
        <span class="badge badge-pill">
            {{ trans('site.discount.percent' , ['discount' => $product->discount_percent]) }}
        </span>
        @endif
    </h2>
    <hr>

    <form action="{{ route('user.cart.store' , ['product' => $product]) }}" method="post">
        @csrf
        @foreach ($product->options as $option)
        <div class="select-box">
            <label for="characters">{{ $option->name }}</label>
            <select id="characters" class="selectpicker form-control" multiple data-live-search="true"
                name="options[{{ $option->id }}][]">
                @foreach ($option->values as $value)
                <option value="{{ $value->id }}">{{ $value->value }}</option>
                @endforeach
            </select>
        </div>
        @endforeach
        <hr>
        <div class="quantity">
            <span class="font-weight-bold font-24 main-color">{{ trans('site.qty') }} </span>
            <div class="qty-input">
                <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                <input class="product-qty" type="number" name="qty" @if($inStock) value="1" min="1"
                    max="{{ $product->amount }}" @else min="0" max="0" value="0" @endif>
                <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
            </div>
            @if($inStock)
            <span class="badge badge-pill badge-success font-18 ml-3">{{ trans('site.in_stock') }} </span>
            @else
            <span class="badge text-white bg-danger font-18 ml-3">{{ trans('site.out_of_stock') }}</span>
            @endif
        </div>
        <hr>
        <div class="add-to-cart">
            <div class="btn-group-sm" role="group" aria-label="">
                @auth
                @role(['user'])
                <button type="submit" class="btn btn-sm btn-info rounded-pill mr-3">
                    <i class="fas fa-shopping-cart mr-2"></i> {{ trans('site.add_to_cart') }}
                </button>
                @livewire('site.wishlist', ['product' => $product])
                @endrole
                @endauth
            </div>
        </div>
    </form>
    <hr>
    <div class="details">
        <h3>{{ trans('site.product_details') }} </h3>
        <p>
            {{ $product->description }}
            {{-- <a href="#" class="main-color d-block font-weight-bold">{{ trans('site.read_more') }} </a> --}}
        </p>
        <div class="share-to">
            <span>
                {{ trans('site.share') }}
            </span>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}">
                <i class="fab fa-facebook-f"></i>
            </a>
        </div>
    </div>
</div>
