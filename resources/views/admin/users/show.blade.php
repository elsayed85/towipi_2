@extends('adminlte::page')

@section('title', 'Users')

@php
$payments = $user->payments;
$orders = $user->orders;
$addresses = $user->addresses;
$complaints = $user->complaints;
$rates = $user->rates;
@endphp

@section('content_header')
<h1 class="m-0 text-dark">User : {{ $user->name }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <h1>payment</h1>
        <table id="admins" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>total</th>
                    <th>method</th>
                    <th>reference id</th>
                    <th>order</th>
                    <th>user</th>
                    <th>Created</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->total }}</td>
                    <td>{{ $payment->method }}</td>
                    <td>{{ $payment->reference_id }}</td>
                    <td>
                        <a
                            href="{{ route('admin.orders.show' , $payment->order) }}">{{ $payment->order->order_number }}</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.users.show' , $user) }}">{{ $user->name }}</a>
                    </td>
                    <td>{{ $payment->created_at }}</td>
                    <td>
                        @permission('payments-delete')
                        <form action="{{ route('admin.payments.destroy' , $payment) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">delete</button>
                        </form>
                        @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <h1>order</h1>
        <table id="order" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>ref number</th>
                    <th>total</th>
                    <th>tax total</th>
                    <th>notes</th>
                    <th>user</th>
                    <th>Created</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->tax_total }}</td>
                    <td>{{ substr($order->notes , 50) }}</td>
                    <td>
                        <a href="{{ route('admin.users.show' , $user) }}">{{ $user->name }}</a>
                    </td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @permission('orders-delete')
                        <form action="{{ route('admin.orders.destroy' , $order) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">delete</button>
                        </form>
                        @endpermission
                        @permission('orders-read')
                        <a href="{{ route('admin.orders.show' , $order) }}" class="btn btn-info">show</a>
                        @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h1>addresses</h1>
        <table id="order" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>title</th>
                    <th>fname</th>
                    <th>lname</th>
                    <th>phone 1</th>
                    <th>phone 2</th>
                    <th>governorate</th>
                    <th>city</th>
                    <th>name</th>
                    <th>notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($addresses as $address)
                <tr>
                    <td>{{ $address->id }}</td>
                    <td>{{ $address->title }}</td>
                    <td>{{ $address->fname }}</td>
                    <td>{{ $address->lname }}</td>
                    <td>{{ $address->phone_1 }}</td>
                    <td>{{ $address->phone_2 }}</td>
                    <td>{{ optional($address->governorate)->name }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->name }}</td>
                    <td>{{ $address->notes }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h1>complaints</h1>
        <table id="order" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>content</th>
                    <th>order</th>
                    <th>product</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->id }}</td>
                    <td>{{ $complaint->content }}</td>
                    <td><a
                            href="{{ route('admin.orders.show' , $complaint->order) }}">{{ $complaint->order->order_number }}</a>
                    </td>
                    <td><a
                            href="{{ route('admin.product.show' , $complaint->product) }}">{{ $complaint->product->title }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h1>review & rates</h1>
        <table id="order" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>rate</th>
                    <th>review</th>
                    <th>product</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rates as $rate)
                <tr>
                    <td>{{ $rate->id }}</td>
                    <td>{{ $rate->value }}</td>
                    <td>
                        {{ $rate->review }}
                    </td>
                    <td><a
                            href="{{ route('admin.product.show' , $rate->product) }}">{{ $rate->product->title }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
