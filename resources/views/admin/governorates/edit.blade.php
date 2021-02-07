@extends('adminlte::page')

@section('title', 'Governorate')

@section('content_header')
<h1 class="m-0 text-dark">Edit Governorate</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            Edit Governorate
        </div>
        <div class="card-body">
            <form action="{{ route('admin.governorate.update' , ['governorate' => $governorate]) }}" method="post">
                @csrf
                @method("patch")
                <x-adminlte-input name="name_en" label="name en" placeholder="name_en" label-class="text-lightblue"
                    value="{{ old('name_en' , $governorate->name_en) }}">
                </x-adminlte-input>

                <x-adminlte-input type="number" name="shipping_price"
                    label="shipping price in ({{ config('app.currency') }}) / example: 1$ = 100cent"
                    placeholder="shipping_price" label-class="text-lightblue"
                    value="{{ old('shipping_price' , $governorate->shipping_price->getAmount()) }}">
                </x-adminlte-input>

                <x-adminlte-select name="country_id" label="Country">
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}" @if(old('country_id' , $governorate->country_id)==$country->id)
                        selected
                        @endif>{{ $country->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Add" />
            </form>
        </div>
    </div>
</div>
@stop
