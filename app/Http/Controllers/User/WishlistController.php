<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = auth()->user()->wishlist()->latest()->with(['product' => function ($query) {
            return $query->with(['translation', 'media']);
        }])->paginate(10);
        return view('user.wishlist', get_defined_vars());
    }

    public function destroy(Wishlist $wishlist)
    {
        abort_unless($wishlist->user_id == auth()->id(), 403);
        $wishlist->delete();
        return back()->withSuccess(trans('site.msg.wishlist_deleted'));
    }

    public function destroyAjax(Request $request)
    {
        $wishlisted = auth()->user()->wishlist()->whereProductId($request->product_id)->first();
        if ($wishlisted) {
            $wishlisted->delete();
            return response()->json(['success' => true, 'wishlist_count' => auth()->user()->wishlist()->count()]);
        }
        return response()->json(['success' => false]);
    }

    public function moveToCart(Wishlist $wishlist)
    {
        abort_unless($wishlist->user_id == auth()->id(), 403);
        $product = $wishlist->product;
        if($product->outOfStock()){
            return back()->withFailed(trans('site.msg.product_is_out_of_stock'));
        }
        $cart = Cart::add($product->id, $product->title, 1, $product->price->getAmount(), 0, $options ?? [])->associate(Product::class);
        if ($product->hasDiscount()) {
            Cart::setDiscount($cart->rowId, $product->discount_percent);
        }
        $wishlist->delete();
        return back()->withSuccess(trans('site.msg.item_moved_to_cart_succfully'));
    }
}
