<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\ShippingAddressRequest;
use App\Models\General\Country;
use App\Models\Product\Option;
use App\Models\Product\OptionValue;
use App\Models\Product\Order;
use App\Models\Product\OrderItem;
use App\Models\Product\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Psy\Command\DumpCommand;

class CheckoutController extends Controller
{
    public function getCheckout()
    {
        $products = Cart::content();
        return view('user.checkout.step1', ['products' => $products]);
    }

    public function checkout(Request $request)
    {
        $cart = Cart::content();

        if (!$cart->count()) {
            return back()->withFailed(trans('site.msg.order.cart_is_empty'));
        }

        $order = auth()->user()->orders()->create([
            'order_number'      =>  strtoupper(uniqid()),
            'total'       =>  Cart::total(),
            'items_count'        =>  Cart::count(),
            'payment_status' =>  false
        ]);

        $order->setPlaced();

        $items = Cart::content()->map(function ($item) {
            $product = Product::find($item->id);
            if ($product) {
                return new OrderItem([
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->qty,
                    'unit_price'         =>  $item->price
                ]);
            }
        });

        $orderItems = $order->items()->saveMany($items);

        Cart::destroy();

        return redirect(route('user.checkout.shipping', ['order' => $order]))->withSuccess(trans('site.msg.order.order_created'));
    }

    public function Shipping(Order $order)
    {
        abort_unless($order->user_id == auth()->id(), 403);
        $countries = Country::ShippingIsEnabled()->get();
        $addresses = auth()->user()->addresses()->with(['governorate'])->get();
        return view('user.checkout.step2', get_defined_vars());
    }

    public function addNewAddress(ShippingAddressRequest $request,  Order $order)
    {
        if ($request->has('address_id')) {
            $address = auth()->user()->addresses()->find($request->address_id);
            if (!$address) {
                return back()->withFailed(trans('site.msg_select_address'));
            }

            $order->shippingAddress()->create([
                'fname' => $address->fname,
                'lname' => $address->lname,
                'phone_1' => $address->phone_1,
                'phone_2' => $address->phone_2,
                'governorate_id' => $address->governorate_id,
                'city' => $address->city,
                'name' => $address->address_name,
            ]);

            if ($notes = $address->notes) {
                $order->update(['notes' => $notes]);
            }
            return redirect(route('user.checkout.payment', ['order' => $order]))->withSuccess(trans('site.msg.shipping address added succfully'));
        }
        $order->shippingAddress()->create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
            'governorate_id' => $request->governorate_id,
            'city' => $request->city,
            'name' => $request->name,
        ]);
        if ($notes = $request->notes) {
            $order->update(['notes' => $notes]);
        }
        return redirect(route('user.checkout.payment', ['order' => $order]))->withSuccess(trans('site.msg.shipping address added succfully'));
    }

    public function payment(Order $order)
    {
        //
    }
}
