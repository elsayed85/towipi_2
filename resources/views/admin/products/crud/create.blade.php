@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
<h1 class="m-0 text-dark">Products</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            Add New Product
        </div>

        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="post">
                @csrf

                @foreach(locales() as $key)
                <x-adminlte-input name="{{ $key }}[title]" label="title
                    ({{ localesAliases($key) }})" placeholder="title {{ localesAliases($key) }}"
                    label-class="text-lightblue" value="{{ old($key . '.title') }}">
                </x-adminlte-input>
                <x-adminlte-input name="{{ $key }}[description]" label="description
                    ({{ localesAliases($key) }})" placeholder="description {{ localesAliases($key) }}"
                    label-class="text-lightblue" value="{{ old($key . '.description') }}">
                </x-adminlte-input>
                @endforeach

                <x-adminlte-input name="price" required label="price ({{ config('app.currency') }})" placeholder="price"
                    label-class="text-lightblue" value="{{ old('price') }}">
                </x-adminlte-input>

                <x-adminlte-input type="number" required name="amount" label="amount" placeholder="amount"
                    label-class="text-lightblue" value="{{ old('amount') }}">
                </x-adminlte-input>

                <x-adminlte-input name="video_url" label="video Url" placeholder="Video Url"
                    label-class="text-lightblue" value="{{ old('video_url') }}">
                </x-adminlte-input>

                <x-adminlte-select name="category_id" required label="category">
                    @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @if(old('category_id') ==$cat->id) selected
                        @endif>{{ $cat->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Add" />
            </form>
        </div>
    </div>
</div>
@stop
