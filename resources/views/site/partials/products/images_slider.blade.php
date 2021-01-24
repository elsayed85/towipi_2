<div class="owl-carousel product-view-gallery" data-slider-id="1">
    @foreach ($product->images() as $image)
    <div data-thumb='<img src="{{ $image->getFullUrl() }}" alt=dummy">' class="item">
        <img src="{{ $image->getFullUrl() }}" alt="dummy">
    </div>
    @endforeach
</div>
