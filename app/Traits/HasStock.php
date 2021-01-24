<?php

namespace App\Traits;

trait HasStock
{

    /*
     |--------------------------------------------------------------------------
     | Methods
     |--------------------------------------------------------------------------
     */

    public function increaseStock($amount = 1)
    {
        return $this->increment('amount', $amount);
    }

    public function decreaseStock($amount = 1)
    {
        return $this->decrement('amount', $amount);
    }

    public function clearStock($newAmount = 0)
    {
        return $this->update(['amount' => $newAmount]);
    }

    public function setStock($newAmount)
    {
        return $this->update(['amount' => $newAmount]);
    }

    public function inStock($amount = 1)
    {
        return $this->amount > 0 && $this->amount >= $amount;
    }

    public function outOfStock()
    {
        return $this->amount <= 0;
    }


    /*
     |--------------------------------------------------------------------------
     | Scopes
     |--------------------------------------------------------------------------
     */

    public function scopeWhereInStock($query, $amount = 1)
    {
        return $query->where("amount", ">=", $amount);
    }

    public function scopeWhereOutOfStock($query)
    {
        return $query->where("amount", "<=", 0);
    }
}
