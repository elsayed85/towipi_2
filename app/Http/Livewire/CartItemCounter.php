<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartItemCounter extends Component
{
    public $rowId;
    public $min = 0;
    public $max = 0;
    public $quantity = 0;

    public function render()
    {
        $this->quantity = Cart::get($this->rowId)->qty;
        return view('livewire.cart-item-counter');
    }

    public function updated($propertyName)
    {
        $this->validate(["quantity" =>  ["min:{$this->min}", "max:{$this->max}"]]);
        if ($propertyName == "quantity" && $this->quantity > 0) {
            Cart::update($this->rowId, $this->quantity);
        }
    }
}
