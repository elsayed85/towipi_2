Payments
@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
<h1 class="m-0 text-dark">Orders</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="order" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>ref number</th>
                    <th>total</th>
                    <th>tax total</th>
                    <th>notes</th>
                    <th>Payment status</th>
                    <th>user</th>
                    <th>complaints count</th>
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
                    <td>{{ $order->isPaid() ? "Paid" : "Not Paid" }}</td>
                    <td>
                        <a href="{{ route('admin.users.show' , $order->user) }}">{{ $order->user->name }}</a>
                    </td>
                    <td>{{ $order->complaints_count }}</td>
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
        {{ $orders->render() }}
    </div>
</div>
@stop
