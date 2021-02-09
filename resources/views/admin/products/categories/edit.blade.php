@extends('adminlte::page')

@section('title', 'Product Category')

@section('content_header')
<h1 class="m-0 text-dark">Product Category : {{ $category->name }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            Edit Product Category : {{ $category->name }} <br>
            @permission('product-category-delete')
            <form action="{{ route('admin.product.category.destroy' , $category) }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger">delete</button>
            </form>
            @endpermission
        </div>

        <div class="card-body">
            <form action="{{ route('admin.product.category.update' , $category) }}" method="post">
                @csrf
                @method("patch")
                @foreach(locales() as $key)
                <x-adminlte-input name="{{ $key }}[name]" label="name
                    ({{ localesAliases($key) }})" placeholder="name {{ localesAliases($key) }}"
                    label-class="text-lightblue"
                    value="{{ old($key . '.name' ,  optional($category->translate($key))->name) }}">
                </x-adminlte-input>
                @endforeach

                <x-adminlte-select name="parent_id">
                    <option value="">Main Category</option>
                    @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @if(old("parent_id" , $category->parent_id) == $cat->id) selected
                        @endif>{{ $cat->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Save" />
            </form>
        </div>
    </div>
</div>
@stop
