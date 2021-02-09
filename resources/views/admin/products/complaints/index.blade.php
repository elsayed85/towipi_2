@extends('adminlte::page')

@section('title', 'complaints')

@section('content_header')
<h1 class="m-0 text-dark">complaints</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="complaints" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <td>content</td>
                    <td>item Id</td>
                    <td>product</td>
                    <td>order</td>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->id }}</td>
                    <td>{{ $complaint->content }}</td>
                    <td>#{{ $complaint->item_id }}</td>
                    <td><a href="{{ route('admin.product.show' , $complaint->product) }}">{{ $complaint->product->title }}</a></td>
                    <td><a href="{{ route('admin.orders.show' , $complaint->order) }}">{{ $complaint->order->order_number }}</a></td>
                    <td>{{ $complaint->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $complaints->render() }}
    </div>
</div>
@stop
