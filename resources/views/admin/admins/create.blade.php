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

                <x-adminlte-input name="fname" label="Fisrt Name" placeholder="First Name" label-class="text-lightblue"
                    value="{{ old('fname') }}">
                </x-adminlte-input>

                <x-adminlte-input name="lname" label="Last Name" placeholder="Last Name" label-class="text-lightblue"
                    value="{{ old('lname') }}">
                </x-adminlte-input>

                <x-adminlte-input name="email" type="email" label="email" placeholder="email"
                    label-class="text-lightblue" value="{{ old('email') }}">
                </x-adminlte-input>

                <x-adminlte-input name="password" type="password" label="password" placeholder="password"
                    label-class="text-lightblue">
                </x-adminlte-input>

                <span class="block text-gray-700 mt-4">Roles</span>
                <div class="flex flex-wrap justify-start mb-4">
                    @foreach ($roles as $role)
                    <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                        <input type="checkbox" @if ($role->assigned && !$role->isRemovable)
                        class="form-checkbox focus:shadow-none focus:border-transparent text-gray-500 h-4 w-4"
                        @else
                        class="form-checkbox h-4 w-4"
                        @endif
                        name="roles[]"
                        value="{{$role->id}}"
                        {!! $role->assigned ? 'checked' : '' !!}
                        {!! $role->assigned && !$role->isRemovable ? 'onclick="return false;"' : '' !!}
                        >
                        <span class="ml-2 {!! $role->assigned && !$role->isRemovable ? 'text-gray-600' : '' !!}">
                            {{$role->display_name ?? $role->name}}
                        </span>
                    </label>
                    @endforeach
                </div>
                @if (isset($permissions))
                <span class="block text-gray-700 mt-4">Permissions</span>
                <div class="flex flex-wrap justify-start mb-4">
                    @foreach ($permissions as $permission)
                    <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                        <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]"
                            value="{{$permission->id}}" {!! $permission->assigned ? 'checked' : '' !!}
                        >
                        <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                    </label>
                    @endforeach
                </div>
                @endif

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Add" />
            </form>
        </div>
    </div>
</div>
@stop
