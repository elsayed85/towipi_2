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
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>

                    <td>{{ $payment->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $payments->render() }}
    </div>
</div>
@stop
