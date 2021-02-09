@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<h1 class="m-0 text-dark">User : {{ $user->name }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            User : {{ $user->name }}
        </div>
        <div class="card-body">
            @permission('users-delete')
            <form action="{{ route('admin.users.destroy' , $user) }}" method="post" style="display: inline-block">
                @csrf
                @method('delete')
                <button class="btn btn-danger">Delete User Forever</button>
            </form>
            @endpermission

            @if($user->is_active)
            <form action="{{ route('admin.users.toggle_activate' , $user) }}" method="post" style="display: inline-block">
                @csrf
                <button class="btn btn-danger"> deactivate</button>
            </form>
            @else
            <form action="{{ route('admin.users.toggle_activate' , $user) }}" method="post" style="display: inline-block">
                @csrf
                <button class="btn btn-info"> activate</button>
            </form>
            @endif

            <form action="{{ route('admin.users.update' , $user) }}" method="post">
                @csrf
                @method("patch")
                <x-adminlte-input name="fname" label="first name" placeholder="first name" label-class="text-lightblue"
                    value="{{ old('fname' , $user->fname) }}">
                </x-adminlte-input>

                <x-adminlte-input name="lname" label="last name" placeholder="last name" label-class="text-lightblue"
                    value="{{ old('lname' , $user->lname) }}">
                </x-adminlte-input>

                <x-adminlte-input type="email" name="email" label="email" placeholder="email"
                    label-class="text-lightblue" value="{{ old('email', $user->email) }}">
                </x-adminlte-input>

                <x-adminlte-input name="phone" label="phone" placeholder="phone" label-class="text-lightblue"
                    value="{{ old('phone' , $user->phone) }}">
                </x-adminlte-input>

                <x-adminlte-select name="country_id" label="Country">
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}" @if(old('country_id' , $user->country_id)==$country->id)
                        selected
                        @endif>{{ $country->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-input name="password" type="password" label="password" placeholder="password"
                    label-class="text-lightblue">
                </x-adminlte-input>

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="save" />
            </form>
        </div>
    </div>
</div>
@stop
