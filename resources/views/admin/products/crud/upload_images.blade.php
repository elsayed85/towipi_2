@extends('adminlte::page')

@section('title', 'upload images')

@section('content_header')
<h1 class="m-0 text-dark">upload images for product {{ $product->name }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            upload images for product {{ $product->name }}
        </div>

        <div class="card-body">
            <form action="{{ route('admin.product.upload_images', ['product' => $product]) }}" method="post"
                enctype="multipart/form-data">
                @csrf

                <x-adminlte-input-file name="images[]" label="Upload files" placeholder="Choose multiple files..."
                    size="lg" legend="Choose" multiple>
                    <x-slot name="appendSlot">
                        <x-adminlte-button theme="primary" label="Upload" />
                    </x-slot>
                    <x-slot name="prependSlot">
                        <div class="input-group-text text-primary">
                            <i class="fas fa-file-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Add" />
            </form>
        </div>
    </div>
</div>
@stop
