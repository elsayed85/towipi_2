<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product\Wishlist;
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

    public function moveToCart(Wishlist $wishlist){

    }
}
