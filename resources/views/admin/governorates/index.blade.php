@extends('adminlte::page')

@section('title', 'governorates')

@section('content_header')
<h1 class="m-0 text-dark">governorates
    @permission('governorate-create')
     | <a href="{{ route('admin.governorate.create') }}" class="btn btn-info">Add New</a>
    @endpermission
</h1>
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
                    <th>actions</th>
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
                    <td>
                        @permission('governorate-delete')
                        <form action="{{ route('admin.governorate.destroy' , $gov) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">delete</button>
                        </form>
                        @endpermission
                        @permission('governorate-update')
                        <a href="{{ route('admin.governorate.edit' , $gov) }}" class="btn btn-info">edit</a>
                        @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $governorates->render() }}
    </div>
</div>
@stop
