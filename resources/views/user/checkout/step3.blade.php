@extends('site.layouts.app')

@section('content')
<section class="order-process order-process-step-3 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-9">
                <h4 class="mb-3 main-color font-30 text-center mb-4">
                    <i class="fas fa-credit-card"></i> {{ trans('site.checkout.step3') }}
                </h4>

                @include('user.partials.checkout.steps')

                @if(request()->has('userCancelled') && request('userCancelled') == true)
                <div class="alert alert-warning" role="alert">
                    {{ trans('site.msg.order.paypal_paymen_cancled') }}
                </div>
                @endif

                @if(config('fawry.enabled'))
                {!! $fawry !!}
                @endif

                <div id="paypal-button-container"></div>

                <form action="{{ route('user.checkout.cash_on_delivery' , ['order' => $order]) }}" method="post"
                    id="cashondeliver_form">
                    @csrf
                    <input type="image" src="{{ asset('assets/cash-on-delivery-icon-14.jpg') }}"
                        onclick="document.getElementById('cashondeliver_form').submit()" style="width: 130px">
                </form>
                <div class="d-flex justify-content-between flex-wrap">
                    <a href="{{ route('user.checkout.shipping' , ['order' => $order]) }}">
                        <button class="btn btn-sm btn-info mr-2 rounded-pill font-14">
                            <i class="fas fa-chevron-left mr-1"></i> {{ trans('site.back_to_shipping') }}
                        </button>
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="border rounded p-3 order-summery">
                    <h4 class="text-center mb-3 font-18 font-weight-bold main-color">
                        {{ trans('order.summery') }}
                    </h4>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between lh-sm mb-2">
                            <span class="my-0 font-15 text-capitalize">{{ trans('order.total_before') }}</span>
                            <span class="font-12"
                                data-total="{{ $order->total->getAmount() }}">{{ $order->total }}</span>
                        </li>
                        <li class="d-flex justify-content-between lh-sm mb-2">
                            <span class="my-0 font-15 text-capitalize">{{ trans('order.shipping_cost') }}</span>
                            <span class="font-12" id="shipping_cost">
                                @if($order->shippingAddress && !is_null($order->shipping_price))
                                {{ $order->shipping_price }}
                                @else
                                ---
                                @endif
                            </span>
                        </li>

                        <li class="border-top pt-2 d-flex justify-content-between border-bottom-0">
                            <span class="font-15">{{ trans('order.total_after') }} </span>
                            @if($order->shippingAddress && !is_null($order->shipping_price))
                            <span class="font-12" data-total="{{ $order->total_with_shipping->getAmount() }}">
                                {{ $order->total_with_shipping }}
                            </span>
                            @else
                            <span class="font-12" data-total="{{ $order->total->getAmount() }}">
                                {{ $order->total }}
                            </span>
                            @endif
                        </li>
                        {{-- <li class=" text-center">
                            <form action="">
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
                                        placeholder="">
                                    <button class="btn btn-info btn-sm rounded-pill font-11 w-100 mt-2">
                                        {{ trans('order._apply_coupon') }}
                                    </button>
                                    <small id="helpId"
                                        class="form-text text-muted font-11">{{ trans('order.coupon_msg') }}</small>
                                </div>

                            </form>
                        </li> --}}

                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
@php
$paypal_client_id = config('paypal_smart.mode') == "sandbox" ? config('paypal_smart.sandbox.client_id') :
config('paypal_smart.live.client_id');
@endphp
<script src="https://www.paypal.com/sdk/js?client-id={{ $paypal_client_id }}&disable-funding=credit,card">
</script>

@if(config('fawry.enabled'))
@if(config('fawry.mode') == "live")
{!! App\Http\Payment\Fawry::jsLive() !!}
@else
{!! App\Http\Payment\Fawry::jsSandBox() !!}
@endif
@endif

<script>
    window.onload = function(){
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        paypal.Buttons({
            createOrder: function(data, actions) {
                return fetch('{{ route('user.payment.paypal.setup_transaction' , ['order' => $order]) }}', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json',
                        "X-CSRF-Token" : token
                    }
                }).then(function(res) {
                    console.log(res)
                    return res.json();
                }).then(function(data) {
                    console.log(data)
                    return data.result.id;
                });
            },

            onApprove: function(data, actions) {
                console.log(data)
                fetch('{{ route('user.payment.paypal.verify_transaction' , ['order' => $order]) }}?paypal_order_id=' + data.orderID , {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                    },
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    console.log(orderData)
                    // Three cases to handle:
                    //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                    //   (2) Other non-recoverable errors -> Show a failure message
                    //   (3) Successful transaction -> Show a success / thank you message
                    // Your server defines the structure of 'orderData', which may differ
                    var errorDetail = Array.isArray(orderData.details) && orderData.details[0];
                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        // Recoverable state, see: "Handle Funding Failures"
                        // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                        return actions.restart();
                    }
                    if (errorDetail) {
                        var msg = 'Sorry, your transaction could not be processed.';
                        if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                        if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                        // Show a failure message
                        return alert(msg);
                    }
                    // Show a success message to the buyer
                   location.replace('{{ route("user.checkout.final_step" , ['order' => $order]) }}');
                });
            },

            onCancel: function(data) {
                location.replace('{{ route("user.checkout.payment" , ['order' => $order]) }}?userCancelled=true')
            }
        }).render('#paypal-button-container');
        // This function displays Smart Payment Buttons on your web page.

        function status(res) {
            if (!res.ok) {
                throw new Error(res.statusText);
            }
            return res;
        }
    }
</script>
@endsection
