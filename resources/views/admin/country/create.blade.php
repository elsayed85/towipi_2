@extends('adminlte::page')

@section('title', 'Countries')

@section('content_header')
<h1 class="m-0 text-dark">Countries</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            Add New Country
        </div>
        <div class="card-body">
            <form action="{{ route('admin.country.store') }}" method="post">
                @csrf
                <x-adminlte-input required name="name" label="name" placeholder="Name" label-class="text-lightblue"
                    value="{{ old('name') }}">
                </x-adminlte-input>

                <x-adminlte-input required name="iso" label="iso" placeholder="iso" label-class="text-lightblue"
                    value="{{ old('iso') }}">
                </x-adminlte-input>

                <x-adminlte-input required type="phonecode" name="phonecode" label="phone code" placeholder="phone code"
                    label-class="text-lightblue" value="{{ old('phonecode') }}">
                </x-adminlte-input>

                <x-adminlte-input name="iso3" label="iso3 (optional)" placeholder="iso3" label-class="text-lightblue"
                    value="{{ old('iso3') }}">
                </x-adminlte-input>

                <x-adminlte-input type="number" name="numcode" label="numcode (optional)" placeholder="numcode"
                    label-class="text-lightblue" value="{{ old('numcode') }}">
                </x-adminlte-input>

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Add" />
            </form>
        </div>
    </div>
</div>
@stop
