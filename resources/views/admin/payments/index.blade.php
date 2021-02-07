@extends('adminlte::page')

@section('title', 'Payments')

@section('content_header')
<h1 class="m-0 text-dark">Payments</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
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
                        <a href="{{ route('admin.users.show' , $payment->user) }}">{{ $payment->user->name }}</a>
                    </td>
                    <td>{{ $payment->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $payments->render() }}
    </div>
</div>
@stop
