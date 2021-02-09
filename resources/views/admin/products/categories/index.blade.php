@extends('adminlte::page')

@section('title', 'categories')

@section('content_header')
<h1 class="m-0 text-dark">categories
    @permission('product-category-create')
    | <a href="{{ route('admin.product.category.create') }}" class="btn btn-info">Add New</a>
    @endpermission</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="categories" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>products count</th>
                    <th>Created</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        @permission('product-category-delete')
                        <form action="{{ route('admin.product.category.destroy' , $category) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">delete</button>
                        </form>
                        @endpermission
                        @permission('product-category-update')
                        <a href="{{ route('admin.product.category.edit' , $category) }}" class="btn btn-info">edit</a>
                        @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->render() }}
    </div>
</div>
@stop
