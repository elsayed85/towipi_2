@extends('adminlte::page')

@section('title', 'products')

@section('content_header')
<h1 class="m-0 text-dark">
    products
    @if($category)
    of category <span class="text-info text-bold">{{ $category->name }}</span>
    @else
    [
    @foreach ($mainCategories as $category)
    <a href="{{ route('admin.product.index' , ['category' => $category->id]) }}">{{ $category->name }}</a> |
    @endforeach
    ]
    @endif
    @permission('products-create')
    | <a href="{{ route('admin.product.create') }}" class="btn btn-info">Add New</a>
    @endpermission
</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        <table id="products" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>title</th>
                    <th>amount/stock</th>
                    <th>price/discount</th>
                    <th>category</th>
                    <th>complaints count</th>
                    <th>Created</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->amount }} @if($product->outOfStock()) / <span class="text-danger text-bold"> out of
                            stock </span> @endif</td>
                    <td>{{ $product->price }} @if($product->hasDiscount()) / {{ $product->discount_percent }}% discount
                        @endif</td>
                    <td>{{ optional($product->category)->name }}</td>
                    <td>{{ $product->complaints_count }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        @permission('products-delete')
                        <form action="{{ route('admin.product.destroy' , $product) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">delete</button>
                        </form>
                        @endpermission
                        @permission('products-read')
                        <a href="{{ route('admin.product.show' , $product) }}" class="btn btn-info">show</a>
                        @endpermission
                        @permission('products-update')
                        <a href="{{ route('admin.product.edit' , $product) }}" class="btn btn-info">edit</a>
                        @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->withQueryString()->render() }}
    </div>
</div>
@stop
