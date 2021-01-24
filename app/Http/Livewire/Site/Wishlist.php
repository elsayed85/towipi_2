<?php

namespace App\Http\Livewire\Site;

use App\Models\Product\Product;
use App\Traits\LivewireLocale;
use Livewire\Component;

class Wishlist extends Component
{
    use LivewireLocale {
        mount as localeMount;
    }

    public Product $product;
    public $isWishlisted = false;
    protected $listeners = [
        'added_to_wislist' => 'removed_from_wislist',
        'removed_from_wislist' => 'removed_from_wislist'
    ];

    public function mount()
    {
        $this->localeMount();
    }

    public function render()
    {
        return view('livewire.site.wishlist');
    }

    public function toggle()
    {
        if (!auth()->user()->isWishlisted($this->product)) {
            auth()->user()->addToWishlist($this->product);
            $this->dispatchBrowserEvent("added_to_wislist", [
                'message' => trans("site.added_to_wishlist"),
                'product_title' => $this->product->title,
                "product_id" => $this->product->id,
                'url' => route('product.show', ['product' => $this->product]),
                'count' => auth()->user()->wishlist()->count()
            ]);
        } else {
            auth()->user()->removeFromWishlist($this->product);
            $this->dispatchBrowserEvent("removed_from_wislist", [
                'message' => trans('site.removed_from_wishlist'),
                'product_title' => $this->product->title,
                "product_id" => $this->product->id,
                'url' => route('product.show', ['product' => $this->product]),
                'count' => auth()->user()->wishlist()->count()
            ]);
        }
    }

    public function added_to_wislist($data)
    {
        return $data;
    }

    public function removed_from_wislist($data)
    {
        return $data;
    }
}
