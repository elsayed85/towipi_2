@extends('adminlte::page')

@section('title', 'governorates')

@section('content_header')
<h1 class="m-0 text-dark">governorates</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="governorates" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>country</th>
                    <th>shipping price</th>
                    <th>addresses count</th>
                    <th>shipping addresses count</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($governorates as $gov)
                <tr>
                    <td>{{ $gov->id }}</td>
                    <td>{{ $gov->name_en }}</td>
                    <td>{{ $gov->country->name }}</td>
                    <td>{{ $gov->shipping_price }}</td>
                    <td>{{ $gov->addresses_count }}</td>
                    <td>{{ $gov->shipping_addresses_count }}</td>
                    <td>{{ $gov->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $governorates->render() }}
    </div>
</div>
@stop
