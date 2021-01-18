@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
<h1 class="m-0 text-dark">Pages</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            Add New Page
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pages.store') }}" method="post">
                @csrf

                <x-adminlte-input required name="title" label="Title" placeholder="Title Of The Page"
                    label-class="text-lightblue" value="{{ old('title') }}">
                </x-adminlte-input>

                <x-adminlte-input required name="slug" label="Url" placeholder="Url Of The Page"
                    label-class="text-lightblue" value="{{ old('slug') }}">
                </x-adminlte-input>

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Add" />
            </form>
        </div>
    </div>
</div>
@stop
