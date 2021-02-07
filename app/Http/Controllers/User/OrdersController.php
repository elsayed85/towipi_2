<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Product\AddComplaintRequest;
use App\Http\Requests\User\Product\AddRateRequest;
use App\Http\Requests\User\Product\ReturnItemRequest;
use App\Models\Product\Order;
use App\Models\Product\OrderItem;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->with([
            'payment',
            'items' => function ($items) {
                return $items->withCount([
                    'complaints' => function ($complaints) {
                        return $complaints->whereUserId(auth()->id());
                    },
                    'returned'
                ]);
            },
            'statuses',
            'items.product.translations',
            'items.product.media',
            "items.rates" => function ($rate) {
                return $rate->whereUserId(auth()->id());
            }
        ])->paginate(5);

        return view('user.orders.index', [
            'orders' => $orders
        ]);
    }

    public function addRate(AddRateRequest $request, Order $order, OrderItem $item)
    {
        abort_if($item->rates()->whereUserId(auth()->id())->exists(), 403);
        $item->rates()->create([
            'value' => $request->rate_value,
            'review' => $request->review,
            'user_id' => auth()->id(),
        ]);
        return redirect(route('user.orders.index'))->withSuccess(trans('site.msg.order.rate_added'));
    }

    public function addComplaint(AddComplaintRequest $request, Order $order, OrderItem $item)
    {
        $item->complaints()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);
        return redirect(route('user.orders.index'))->withSuccess(trans('site.msg.order.complaint_added'));
    }

    public function addItemToReturnedItems(ReturnItemRequest $request, Order $order, OrderItem $item)
    {
        if ($item->isReturned()) {
            return redirect(route('user.orders.index'));
        }
        $item->returned()->create([
            'message' => $request->message,
            'user_id' => auth()->id()
        ]);
        return redirect(route('user.orders.index'))->withFailed(trans('site.msg.item_returned_succfully'));
    }
}
