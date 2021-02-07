<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use App\Models\Product\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalHttp\HttpException;

class PaypalController extends Controller
{
    public $mode;
    public $clientId;
    public $clientSecret;

    public function __construct()
    {
        $this->mode = config('paypal_smart.mode');
        $this->clientId = $this->mode == "sandbox" ? config('paypal_smart.sandbox.client_id') : config('paypal_smart.live.client_id');
        $this->clientSecret = $this->mode == "sandbox" ? config('paypal_smart.sandbox.secret') : config('paypal_smart.live.secret');
    }

    public function setUpTransaction(Request $request, Order $order)
    {
        abort_unless($order->user_id == auth()->id(), 403);
        abort_if($order->isPaid(), 404);
        $order->load(['shippingAddress.governorate.country', 'items.product.translations']);

        $shippingAddress = $order->shippingAddress;
        $currency = config('app.currency');

        $paypalOrder = new OrdersCreateRequest();
        $paypalOrder->prefer('return=representation');

        $paypalOrder->body = [
            'intent' => 'CAPTURE',
            'application_context' => [
                'brand_name' => config('app.name'),
                'locale' => 'en-US',
                'landing_page' => 'BILLING',
                'shipping_preferences' => 'SET_PROVIDED_ADDRESS',
                'user_action' => 'PAY_NOW',
                'return_url' => route('user.checkout.final_step', ['order' => $order]),
                'cancel_url' => route('user.checkout.payment', ['payment' => 'cancelled', 'order' => $order]),
            ],
            'purchase_units' => [
                [
                    'reference_id' => $order->order_number,
                    'amount' => [
                        'currency_code' => $currency,
                        'value' => $order->total_with_shipping->formatByDecimal(),
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => $currency,
                                'value' => $order->total->formatByDecimal(),
                            ],
                            'shipping' => [
                                'currency_code' => $currency,
                                'value' => $order->shipping_price->formatByDecimal(),
                            ],
                            'tax_total' =>
                            array(
                                'currency_code' => $currency,
                                'value' => $order->tax_total->formatByDecimal(),
                            ),
                        ],
                    ],
                    'shipping' => [
                        'address' => [
                            'address_line_1' => $shippingAddress->city,
                            'address_line_2' => $shippingAddress->governorate->country->name,
                            'admin_area_2' => $shippingAddress->governorate->name_en,
                            'admin_area_1' => $shippingAddress->name,
                            'country_code' => $shippingAddress->governorate->country->iso,
                        ],
                    ]
                ],
            ],
        ];


        $environment = new SandboxEnvironment($this->clientId, $this->clientSecret);
        $client = new PayPalHttpClient($environment);
        $response = $client->execute($paypalOrder);
        return Response::json($response);
    }

    public function verifyTransaction(Request $request, Order $order)
    {
        abort_unless($order->user_id == auth()->id(), 403);
        abort_if($order->isPaid(), 404);
        abort_unless($request->has('paypal_order_id'), 403);
        $order->load(['items.product']);
        $environment = new SandboxEnvironment($this->clientId, $this->clientSecret);
        $client = new PayPalHttpClient($environment);
        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
        // $response->result->id gives the orderId of the order created above
        $pyapalRequest = new OrdersCaptureRequest($request->paypal_order_id);
        $pyapalRequest->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($pyapalRequest);
            $jsonResponse = json_encode($response);
            $result = (object) $response->result;
            if ($result->status == "COMPLETED") {
                $order->setAsPaid()->save();
                $order->items()->each(function ($item) {
                    $item->product->decreaseStock($item->quantity);
                });
                $amount = $result->purchase_units[0]->amount;
                $payment = $order->payment()->create([
                    'user_id' => auth()->id(),
                    'total' => $amount->value,
                    'currency_code' => $amount->currency_code,
                    'method' => 'paypal',
                    'reference_id' => $result->id
                ]);
            }
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            echo $jsonResponse;
            die;
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            die;
            //print_r($ex->getMessage());
        }
    }
}
