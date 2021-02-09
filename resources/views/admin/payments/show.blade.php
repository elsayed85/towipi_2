@extends('adminlte::page')

@section('title', 'Payments')

@php
$order = $payment->order;
@endphp

@section('content_header')
<h1 class="m-0 text-dark">Payments of order {{ $order->order_number }}</h1>
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
                        <a href="{{ route('admin.users.show' , $payment->user) }}">{{ $payment->user->name }}</a>
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
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->tax_total }}</td>
                    <td>{{ substr($order->notes , 50) }}</td>
                    <td>
                        <a href="{{ route('admin.users.show' , $order->user) }}">{{ $order->user->name }}</a>
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
            </tbody>
        </table>
    </div>
</div>
@stop
