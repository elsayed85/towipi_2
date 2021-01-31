@php
$inStock = $product->inStock();
@endphp
<div class="product-details">
    <h1>
        {{ $product->title }}
    </h1>
    <h2>
        EGP 5.00
        {{-- <span class="badge badge-pill">
            -25% off
        </span> --}}
    </h2>
    <hr>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="select-box">
                <label for="characters">Characters</label>
                <select id="characters" class="form-control">
                    <option selected>Choose</option>
                    <option>Mickey mouse</option>
                    <option>Frozen</option>
                    <option>Super Mario</option>
                    <option>Moana</option>
                    <option>Sonic</option>
                    <option>Paw Patrol</option>
                    <option>Mickey Mouse</option>
                    <option>Coco</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="select-box">
                <label for="size">Cupcake size</label>
                <select id="size" class="form-control">
                    <option selected>Choose</option>
                    <option>Mickey mouse</option>
                    <option>Frozen</option>
                    <option>Super Mario</option>
                    <option>Moana</option>
                    <option>Sonic</option>
                    <option>Paw Patrol</option>
                    <option>Mickey Mouse</option>
                    <option>Coco</option>
                </select>
            </div>
        </div>

    </div>
    <hr>
    <div class="quantity">
        <span class="font-weight-bold font-24 main-color">QTY</span>
        <div class="qty-input">
            <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
            <input class="product-qty" type="number" name="product-qty" @if($inStock) value="1" min="1"
                max="{{ $product->amount }}" @else min="0" max="0" value="0" @endif>
            <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
        </div>
        @if($inStock)
        <span class="badge badge-pill badge-success font-18 ml-3">In stock</span>
        @else
        <span class="badge text-white bg-danger font-18 ml-3">Out Of Stock</span>
        @endif
    </div>
    <hr>
    <div class="add-to-cart">
        <div class="btn-group-sm" role="group" aria-label="">
            @auth
            @role(['user'])
            <button type="button" class="btn btn-sm btn-info rounded-pill mr-3">
                <i class="fas fa-shopping-cart mr-2"></i> Add to cart
            </button>
            @livewire('site.wishlist', ['product' => $product])
            @endrole
            @endauth
        </div>
    </div>
    <hr>
    <div class="details">
        <h3>Product Details </h3>
        <p>
            {{ $product->description }}
            <a href="#" class="main-color d-block font-weight-bold">Read More</a>
        </p>
        <div class="share-to">
            <span>
                Share :
            </span>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}">
                <i class="fab fa-facebook-f"></i>
            </a>

        </div>
    </div>
</div>
