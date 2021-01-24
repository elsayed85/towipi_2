<?php

namespace App\Traits;

use App\Models\Product\Product;
use App\Models\Product\Wishlist;

trait HasWishlist
{
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function clearWishlist()
    {
        return $this->wishlist()->delete();
    }

    public function removeFromWishlist(Product $product)
    {
        return $this->wishlist()->whereProductId($product->id)->delete();
    }

    public function addToWishlist(Product $product)
    {
        return $this->wishlist()->create([
            'product_id' => $product->id
        ]);
    }

    public function isWishlisted(Product $product)
    {
        return $this->wishlist()->whereProductId($product->id)->exists();
    }

    public function toggleWihslist(Product $product)
    {
        return $this->isWishlisted($product) ? $this->removeFromWishlist($product) : $this->addToWishlist($product);
    }
}
