@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
<h1 class="m-0 text-dark">Settings</h1>
@stop

@section('content')
<div class="card">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Update Info
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.updateInfo') }}" method="post">
                        @csrf
                        @method('put')
                        <x-adminlte-input name="name" label="name" placeholder="Name" label-class="text-lightblue"
                            value="{{ old('name' , auth()->user()->name) }}">
                        </x-adminlte-input>

                        <x-adminlte-input name="email" label="email" placeholder="email" label-class="text-lightblue"
                            value="{{ old('email' , auth()->user()->email) }}">
                        </x-adminlte-input>

                        <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="submit" />
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    change password
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.updatePassword') }}" method="post">
                        @csrf
                        @method('put')
                        <x-adminlte-input name="password" type="password" label="password" placeholder="password"
                            label-class="text-lightblue">
                        </x-adminlte-input>

                        <x-adminlte-input name="new_password" type="password" label="new password"
                            placeholder="new password" label-class="text-lightblue">
                        </x-adminlte-input>


                        <x-adminlte-input name="new_password_confirmation" type="password"
                            label="new password confirmation" placeholder="new password confirmation"
                            label-class="text-lightblue">
                        </x-adminlte-input>

                        <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
