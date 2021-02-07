<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product\Option;
use App\Models\Product\OptionValue;
use App\Models\Product\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request, Product $product)
    {
        abort_if($product->outOfStock() , 404);
        $options =  [];
        if ($request->has('options')) {
            $options = [
                collect($request->options)->keys()->map(function ($optionId) {
                    $option = Option::find($optionId);
                    return ['id' => $option->id, 'name' => $option->name];
                }),
                collect($request->options)->values()->map(function ($valueId) {
                    return OptionValue::find($valueId)->map(function ($el) {
                        return ['id' => $el->id, 'name' => $el->value];
                    });;
                })
            ];
        }

        $cart = Cart::add($product->id, $product->title, $request->qty, $product->price->getAmount(), 0, $options ?? [])->associate(Product::class);
        if ($product->hasDiscount()) {
            Cart::setDiscount($cart->rowId, $product->discount_percent);
        }
        return back()->withSuccess(trans('site.cart.product_addedd'));
    }

    public function remove($item)
    {
        try {
            Cart::remove($item);
        } catch (\Throwable $th) {
            return back()->withFailed(trans('site.error'));
        }
        return back()->withSuccess(trans('site.cart.product_removed'));
    }

    public function clear()
    {
        Cart::destroy();
        return back()->withSuccess(trans('site.cart.cart_is_cleared'));
    }
}
