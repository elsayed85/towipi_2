@extends('adminlte::page')

@section('title', 'orders')

@section('content_header')
<h1 class="m-0 text-dark">order {{ $order->order_number }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p>
                    id : {{ $order->id }} <br>
                    user : <a href="{{ route('admin.users.show' , $order->user) }}">{{ $order->user->name }}</a> <br>
                    ref number : {{ $order->order_number }} <br>
                    items count : {{ $order->items_count }} <br>
                    total price : <b>{{ $order->total }}</b> <br>
                    tax total price : {{ $order->tax_total }} <br>
                    notes : {{ $order->notes }}
                </p>
            </div>
            <div class="col-md-6">
                States History (current state :<b> {{ $order->status }}</b>) <br>
                <table class="table table-light">
                    <tbody>
                        <thead>
                            <tr>
                                <th>status</th>
                                <th>At</th>
                            </tr>
                        </thead>
                        @foreach ($order->statuses as $status)
                        <tr>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="">Actions : </label>
                <form action="{{ route('admin.orders.destroy' , $order) }}" method="post" style="display: inline-block">
                    @csrf
                    @method("delete")
                    <button class="btn btn-danger">Delete Order {{ $order->order_number }}</button>
                </form>
                <form action="{{ route('admin.orders.tracking.action' , $order) }}" method="post"
                    style="display: inline-block">
                    @csrf
                    <input type="hidden" name="action_name" value="placed">
                    <button class="btn btn-info">Order Placed</button>
                </form>
                <form action="{{ route('admin.orders.tracking.action' , $order) }}" method="post"
                    style="display: inline-block">
                    @csrf
                    <input type="hidden" name="action_name" value="confirmed">
                    <button class="btn btn-info">Order confirmed</button>
                </form>
                <form action="{{ route('admin.orders.tracking.action' , $order) }}" method="post"
                    style="display: inline-block">
                    @csrf
                    <input type="hidden" name="action_name" value="readyforshipping">
                    <button class="btn btn-info">ready for shipping</button>
                </form>
                <form action="{{ route('admin.orders.tracking.action' , $order) }}" method="post"
                    style="display: inline-block">
                    @csrf
                    <input type="hidden" name="action_name" value="shipped">
                    <button class="btn btn-info">Order shipped</button>
                </form>
                <form action="{{ route('admin.orders.tracking.action' , $order) }}" method="post"
                    style="display: inline-block">
                    @csrf
                    <input type="hidden" name="action_name" value="delivered">
                    <button class="btn btn-info">Order delivered</button>
                </form>
            </div>
        </div>

        <hr>
        @if($shippingAddress = $order->shippingAddress)
        <label for="">Shipping Address</label>
        <table id="address" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>phone 1</th>
                    <th>phone 2</th>
                    <th>name</th>
                    <th>city</th>
                    <th>governorate</th>
                    <th>country</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td> {{ $shippingAddress->id }}</td>
                    <td>{{ $shippingAddress->fname . " " . $shippingAddress->lname }}</td>
                    <td> {{ $shippingAddress->phone_1 }}</td>
                    <td>{{ $shippingAddress->phone_2 }}</td>
                    <td>{{ $shippingAddress->name }}</td>
                    <td>{{ $shippingAddress->city }}</td>
                    <td>{{ $shippingAddress->governorate->name_en }}</td>
                    <td>{{ $shippingAddress->governorate->country->name }}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        @endif

        @if($payment = $order->payment)
        <label>payment</label>
        <table id="payment" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>total</th>
                    <th>method</th>
                    <th>reference id</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->total }}</td>
                    <td>{{ $payment->method }}</td>
                    <td>{{ $payment->reference_id }}</td>>
                    <td>{{ $payment->created_at }}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        @endif

        <label for="">Order Items</label>
        <table id="items" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>product</th>
                    <th>quantity</th>
                    <th>specifications</th>
                    <th>review</th>
                    <th>complaints</th>
                    <th>returned</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                @php
                $product = $item->product;
                @endphp
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ route('admin.product.show' , $product) }}">{{ $product->title }}</a></td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        @if(count($item->options) == 2)
                        @php
                        $options = $item->options[0];
                        $values = $item->options[1];
                        @endphp
                        <ul class="list-unstyled font-12">
                            @foreach ($options as $option)
                            <li>
                                {{ $option->name ?? "" }} :
                                @foreach ($values as $valueData)
                                @foreach ($valueData as $value)
                                <span class="primary-color">{{ $value->name }}</span> ,
                                @endforeach
                                @endforeach
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </td>
                    <td>
                        @if($rate = $item->rate)
                        Rate : {{ $rate->value }} <br>
                        @if($review = $rate->review)
                        review : {{ $review }}
                        @endif
                        @endif
                    </td>
                    <td>
                        @if($complaints = $order->complaints)
                        <table class="table table-light">
                            <tbody>
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>content</th>
                                    </tr>
                                </thead>
                                @foreach ($complaints as $complaint)
                                <tr>
                                    <td>{{ $complaint->id }}</td>
                                    <td>{{ $complaint->content }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </td>
                    <td>
                        @if($returned = $item->returned)
                        At {{ $returned->created_at }} <br>
                        message : {{ $returned->message }} <br>
                        status : <b>{{ $returned->status_str }}</b> <br>
                        @if(!$returned->isAccepted())
                        <form style="display: inline-block;"
                            action="{{ route('admin.orders.returned_item_action' , ['order' => $order , 'item' => $returned]) }}"
                            method="post">
                            @csrf
                            @method("patch")
                            <input type="hidden" name="action_name" value="accept">
                            <button class="btn btn-default" type="submit">Accept</button>
                        </form>
                        @endif

                        @if(!$returned->isRejected())
                        <form style="display: inline-block;"
                            action="{{ route('admin.orders.returned_item_action' , ['order' => $order , 'item' => $returned]) }}"
                            method="post">
                            @csrf
                            @method("patch")
                            <input type="hidden" name="action_name" value="reject">
                            <button class="btn btn-default" type="submit">Reject</button>
                        </form>
                        @endif

                        @if(!$returned->isWaitingForAccept())
                        <form style="display: inline-block;"
                            action="{{ route('admin.orders.returned_item_action' , ['order' => $order , 'item' => $returned]) }}"
                            method="post">
                            @csrf
                            @method("patch")
                            <input type="hidden" name="action_name" value="waiting">
                            <button class="btn btn-default" type="submit">Waiting</button>
                        </form>
                        @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
