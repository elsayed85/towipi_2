@extends('site.layouts.app')

@section('content')
<section class="user-profile user-orders mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('user.partials.sidebar')
            </div>
            <div class="col-12 col-md-8">
                @if($orders->total())
                @foreach ($orders as $order)
                @php
                $payment = optional($order->payment);
                @endphp
                <div class="p-3 border rounded">
                    <div class="mb-4 border-bottom pb-3">
                        <span class="d-flex align-items-center justify-content-between flex-wrap">
                            @if($payment)
                            <span>{{ trans('site.purchasing_date') }} {{ $payment->created_at->format("Y-m-d") }}</span>
                            <span>{{ trans('site.payment_method:') }} {{ $payment->method }}</span>
                            @else
                            <span>{{ trans('site.msg.order.not_paied_yet') }}</span>
                            @endif
                        </span>
                        <span class="d-flex align-items-center justify-content-between flex-wrap">
                            <span>{{ trans('site.order_number') }} #{{ $order->order_number }}</span>
                            <span>{{ trans('order.total_after') }} {{ $order->total }}</span>
                        </span>
                    </div>
                    @include('user.partials.orders.states' , ['order' => $order])
                    <div class="table-responsive">
                        <table class="table table-borderless cart-items-list">
                            <thead>
                                <tr>
                                    <th scope="col">{{ trans('site.photo') }}</th>
                                    <th scope="col">{{ trans('site.details') }}</th>
                                    <th scope="col">{{ trans('site.actions.name') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="product-photo">
                                            <img src="{{ $item->product->firstImage() }}" alt="dummy">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-details">
                                            <h6 class="font-12 text-capitalize main-color font-weight-bold">
                                                {{ $item->product->title }}
                                            </h6>
                                            @if($payment)
                                            @if($item->complaints_count > 0)
                                            <span class="text-danger">{{ trans('site.order.complaints_count') }} :
                                                {{ $item->complaints_count }} <br></span>
                                            @endif
                                            @if($returnedIitem = $item->returned)
                                            <span class="text-info">
                                                @if($returnedIitem->isWaitingForAccept())
                                                {{ trans('site.return_item.status.waiting_msg') }}
                                                @elseif($returnedIitem->isAccepted())
                                                {{ trans('site.return_item.status.accepted_msg') }}
                                                @elseif($returnedIitem->isRejected())
                                                {{ trans('site.return_item.status.rejected_msg') }}
                                                @endif
                                            </span>
                                            @endif
                                            @if($rate = $item->rates->first())
                                            <p>
                                                <div class="d-flex align-items-center">
                                                    {{ trans('site.rate') }} : {{ $rate->value }}
                                                </div>
                                                <p class="comment">
                                                    {{ $rate->review }}
                                                </p>
                                            </p>
                                            @else
                                            @include('user.partials.orders.addRateForm')
                                            @endif
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="actions ">
                                            @if($payment)
                                            <button class="mb-1 btn btn-sm btn-secondary font-10 rounded-pill mr-2"
                                                data-toggle="modal" data-target="#addComplaint-{{ $item->id }}">
                                                {{ trans('site.file_complant') }}
                                            </button>
                                            @include('user.partials.orders.addComplaintForm' , ['order' => $order ,
                                            'item' => $item])
                                            <br>
                                            @if(!$item->returned)
                                            <button class="mb-1 btn btn-sm btn-secondary font-10 rounded-pill mr-2"
                                                data-toggle="modal" data-target="#returnItemForm-{{ $item->id }}">
                                                {{ trans('site.return_item.text') }}
                                            </button>
                                            @include('user.partials.orders.returnItemForm' , ['order' => $order , 'item'
                                            => $item])
                                            @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
                {{ $orders->render() }}
                @else
                {{ trans('site.msg.no_orders_yet') }}
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
