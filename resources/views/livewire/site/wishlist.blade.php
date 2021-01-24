<button type="button" class="btn btn-danger rounded-pill main-color font-18" wire:click="toggle()">
    <i class="far fa-heart mr-2"></i>
     @if(!auth()->user()->isWishlisted($product))
    {{ trans('site.add_to_wishlist') }}
    @else
    {{ trans('site.remove_to_wishlist') }}
    @endif
</button>
