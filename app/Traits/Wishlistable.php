<?php

namespace App\Traits;

use App\Http\Livewire\Site\Wishlist;

trait Wishlistable
{
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function isWishlisted($userId = null)
    {
        return $this->wishlists()->whereUserId(is_null($userId) ? auth()->id() : $userId)->exists();
    }
}
