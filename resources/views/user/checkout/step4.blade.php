@extends('site.layouts.app')

@section('content')
<section class="order-process order-process-step-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-9">
                <h4 class="mb-3 main-color font-30 text-center mb-4">
                    <i class="fas fa-shopping-cart"></i> Your Shopping Cart
                </h4>

                @include('user.partials.checkout.steps')


                <div class="process-success d-flex align-items-center mt-4">
                    <i class="fas fa-check-circle"></i>
                   {!! $message !!}
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
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')

@endsection
