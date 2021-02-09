@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<h1 class="m-0 text-dark">Users</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        <table id="Users" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>country</th>
                    <th>Activate</th>
                    <th>orders count</th>
                    <th>Created</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ optional($user->country)->name }}</td>
                    <td>
                        @permission('users-update')
                        @if($user->is_active)
                        <form action="{{ route('admin.users.toggle_activate' , $user) }}" method="post">
                            @csrf
                            <button class="btn btn-danger"> deactivate</button>
                        </form>
                        @else
                        <form action="{{ route('admin.users.toggle_activate' , $user) }}" method="post">
                            @csrf
                            <button class="btn btn-info"> activate</button>
                        </form>
                        @endif
                        @endpermission
                    </td>
                    <td>{{ $user->orders_count }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @permission('users-delete')
                        <form action="{{ route('admin.users.destroy' , $user) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">delete</button>
                        </form>
                        @endpermission
                        @permission('users-read')
                        <a href="{{ route('admin.users.show' , $user) }}" class="btn btn-info">show</a>
                        @endpermission
                        @permission('users-update')
                        <a href="{{ route('admin.users.edit' , $user) }}" class="btn btn-info">edit</a>
                        @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->render() }}
    </div>
</div>
@stop
