<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product\Order;
use App\Models\Product\ReturnedItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->with(['user:id,fname,lname', 'payment'])->withCount(['complaints'])->paginate(10);
        return view('admin.orders.index',  get_defined_vars());
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product.translations', 'statuses',  'payment', 'items.rate', 'shippingAddress.governorate.country', 'items.complaints']);
        return view('admin.orders.show', get_defined_vars());
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect(route('admin.orders.index'))->withSuccess("order {$order->order_number} deleted");
    }

    public function returnedItemAction(Request $request, Order $order, ReturnedItem $item)
    {
        if ($request->action_name == "accept") {
            $item->update(['accepeted' => true]);
        } elseif ($request->action_name == "reject") {
            $item->update(['accepeted' => false]);
        } elseif ($request->action_name == "waiting") {
            $item->update(['accepeted' => null]);
        }
        return redirect(route('admin.orders.show', ['order' => $order]))->withSuccess('done');
    }

    public function trackingAction(Request $request, Order $order)
    {
        $action = $request->action_name;
        if ($action == "placed") {
            $order->setPlaced();
        } elseif ($action == "readyforshipping") {
            $order->setReadyForShipping();
        } elseif ($action == "shipped") {
            $order->setShipped();
        } elseif ($action == "delivered") {
            $order->setDelivered();
        } elseif ($action == "confirmed") {
            $order->setConfirmed();
        }
        return redirect(route('admin.orders.show', ['order' => $order]))->withSuccess("order state is {$order->status} now`     ");
    }
}
