<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-heart font-26"></i>
        <span class="count-favorites count wishlist_count">{{ $wishlist->count() }}</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <ul class="list-unstyled w-100 favorites-list wishlist_ul">
            <li class="d-flex justify-content-between align-items-center pb-2">
                <h6 class="font-13 mb-0">
                    {{ trans('site.favorites') }} <i class="fas fa-heart ml-1"></i>
                </h6>
                <span class="font-12 badge badge-dark wishlist_count">{{ $wishlist->count() }}</span>
            </li>
            @forelse ($wishlist as $item)
            <li class="d-flex justify-content-between align-items-center" id="product_{{ $item->product->id }}">
                <a href="{{ route('product.show' , $item->product) }}">
                    {{ $item->product->title }}
                </a>
                <a href="#" class="text-danger delete-favorite-btn remove_wishlist_elemnt"
                    data-product-id="{{ $item->product->id }}" onclick="removeWishlistElement(this)">
                    <i class="far fa-times-circle"></i>
                </a>
            </li>
            @empty

            @endforelse
        </ul>
    </div>
</li>
