@extends('adminlte::page')

@section('title', 'Options')

@section('content_header')
<h1 class="m-0 text-dark">Add Options to product {{ $product->title }}</h1>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/3.22.1/tagify.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            Add Options to product {{ $product->title }}
        </div>

        <div class="card-body">
            <form action="{{ route('admin.product.options.store' , ['product' => $product]) }}" method="post">
                @csrf
                <x-adminlte-input name="option_name" label="option_name" placeholder="option_name"
                    label-class="text-lightblue" value="{{ old('option_name') }}">
                </x-adminlte-input>

                <x-adminlte-input class="option_values" name="values" label="values" placeholder="values"
                    label-class="text-lightblue" value="{{ old('values') }}">
                </x-adminlte-input>

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Add" />
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/3.22.1/tagify.min.js"></script>
<script>
var input = document.querySelector('.option_values'),
    tagify = new Tagify(input)
</script>
@endsection
