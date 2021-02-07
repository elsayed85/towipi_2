@extends('adminlte::page')

@section('title', 'Admins')

@section('content_header')
<h1 class="m-0 text-dark">Admins</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            Add New Admin
        </div>

        <div class="card-body">
            <form action="{{ route('admin.admin.store') }}" method="post">
                @csrf
                <x-adminlte-input name="fname" label="name" placeholder="name" label-class="text-lightblue"
                    value="{{ old('fname') }}">
                </x-adminlte-input>

                <x-adminlte-select name="country_id">
                    <option value="gggg"></option>

                </x-adminlte-select>

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Add" />
            </form>
        </div>
    </div>
</div>
@stop
