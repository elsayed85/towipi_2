@extends('adminlte::page')

@section('title', 'products')

@section('content_header')
<h1 class="m-0 text-dark">Product {{ $product->title }}
    @permission('products-update')
    | <a href="{{ route('admin.product.edit' , $product) }}" class="btn btn-info">Edit</a>
    @endpermission
    @permission('products-delete')
    | <form action="{{ route('admin.product.destroy' , $product) }}" method="post" style="display: inline-block">
        @csrf
        @method('delete')
        <button class="btn btn-danger">Delete</button>
    </form>
    @endpermission
</h1>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('assets/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <p>
                id : {{ $product->id }} <br>
                title : {{ $product->title }} <br>
                price : <b>{{ $product->price }}</b> <br>
                amount : <b>{{ $product->amount }}</b> <br>
                @if($product->hasDiscount())
                discount : <b>{{ $product->discount_percent }}%</b> <br>
                @endif
                category : {{ $product->category->name }} <br>
                created : {{ $product->created_at }} <br>
                @if($video_url = $product->video_url)
                video : <a href="{{ $video_url }}" target="_blank" rel="noopener noreferrer">open</a> <br>
                @endif
                complaints count : {{ $product->complaints_count }} <br>
                Stock Status : {{ $product->outOfStock() ? "Out Of Stock" : "In Stock" }}
            </p>
        </div>

        <label for="">Product Options | <a href="{{ route('admin.product.options.create' , ['product' => $product]) }}"
                class="btn btn-info">Add New</a></label>
        <table id="items" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>option</th>
                    <th>value</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product->options as $option)
                <tr>
                    <td>{{ $option->name }} |
                        <form
                            action="{{ route('admin.product.options.delete_option' , ['option' => $option , 'product' => $product]) }}"
                            method="post" style="display: inline-block">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <table class="table table-light">
                            <tbody>
                                @foreach ($option->values as $value)
                                <tr>
                                    <td>{{ $value->value }} | <form
                                            action="{{ route('admin.product.options.delete_value' , ['product' => $product , 'value' => $value]) }}"
                                            method="post" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <div class="card-body">
            <div class="row">
                <label for="">Product Images | <a
                        href="{{ route('admin.product.upload_images' , ['product' => $product]) }}"
                        class="btn btn-info">Add New</a></label>
                <br>
                @foreach ($product->images() as $image)
                <div class="col-sm-2">
                    <img src="{{ $image->getFullUrl() }}" class="img-fluid mb-2" alt="white sample" />
                    <form
                        action="{{ route('admin.product.delete_image' , ['image' => $image , 'product' => $product]) }}"
                        method="post">
                        @csrf
                        @method("delete")
                        <button class="btn btn-danger">delete image</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @stop
    @section('js')
    <script src="{{ asset('assets/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    @endsection
