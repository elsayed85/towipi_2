@extends('adminlte::page')

@section('title', 'Product Category')

@section('content_header')
<h1 class="m-0 text-dark">Product Category</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            Add Product Category
        </div>

        <div class="card-body">
            <form action="{{ route('admin.product.category.store') }}" method="post">
                @csrf
                @foreach(locales() as $key)
                <x-adminlte-input name="{{ $key }}[name]" label="name
                    ({{ localesAliases($key) }})" placeholder="name {{ localesAliases($key) }}"
                    label-class="text-lightblue" value="{{ old($key . '.name') }}">
                </x-adminlte-input>
                @endforeach

                <x-adminlte-select name="parent_id">
                    <option value="">Main Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == old('parent_id')) selected
                        @endif>{{ $category->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Add" />
            </form>
        </div>
    </div>
</div>
@stop
