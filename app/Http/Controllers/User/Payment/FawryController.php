<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use App\Models\Product\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FawryController extends Controller
{
    public function success(Request $request, Order $order)
    {
        abort_unless($order->user_id == auth()->id(), 403);
        abort_if($order->isPaid(), 403, "Order Already Paid");
        if ($request->statusCode == 200 && $request->orderStatus == "PAID") {
            $order->load(['items.product']);
            $order->setAsPaid()->save();
            $order->items()->each(function ($item) {
                $item->product->decreaseStock($item->quantity);
            });
            $payment = $order->payment()->create([
                'user_id' => auth()->id(),
                'total' => $request->paymentAmount,
                'method' => 'fawry ' . $request->paymentMethod,
                'reference_id' => $request->referenceNumber
            ]);
        }
        Log::channel('fawry')->info(['order_id' => $order->id, 'user_id' => auth()->id(), 'status' => 'failed', 'refNumber' => $request->merchantRefNum]);
        return redirect(route('user.checkout.payment', ['order' => $order, 'payment-status' => "failed", "payment-method" => 'fawry']));
    }

    public function failed(Request $request, Order $order)
    {
        abort_unless($order->user_id == auth()->id(), 403);
        abort_if($order->isPaid(), 404);
        if ($request->has('merchantRefNum')) {
            Log::channel('fawry')->info(['order_id' => $order->id, 'user_id' => auth()->id(), 'status' => 'failed', 'refNumber' => $request->merchantRefNum]);
            return redirect(route('user.checkout.payment', ['order' => $order, 'payment-status' => "failed", "payment-method" => 'fawry']));
        }
        return redirect(route('user.checkout.payment', ['order' => $order]));
    }
}
