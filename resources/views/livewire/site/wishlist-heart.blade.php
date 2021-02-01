<button type="button" class="btn-add-to-favorite" wire:click="toggle()">
    @if(!auth()->user()->isWishlisted($product))
    <i class="far fa-heart"></i>
    @else
    <i class="fas fa-heart"></i>
    @endif
</button>
