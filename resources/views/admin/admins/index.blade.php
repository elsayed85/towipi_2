@extends('adminlte::page')

@section('title', 'Admins')

@section('content_header')
<h1 class="m-0 text-dark">Admins</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="admins" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>permissions</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@stop

@section('js')
<script>
    $(document).ready( function () {
    $('#admins').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.admin.index')}}",
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf' , 'print',
        @if(auth()->user()->isAbleTo('admins-create'))
            {
                text: 'Add New Admin',
                action: function ( e, dt, node, config ) {
                    location.replace("{{ route('admin.admin.create') }}");
                }
            }
        @endif
    ],
      columns: [
        { data: 'id', name: 'id' },
        { data: 'fname', name: 'fname' },
        { data: 'lname', name: 'lname' },
        { data: 'email', name: 'email' },
        { data: 'roles', name: 'roles' },
        { data: 'permissions', name: 'permissions' },
        { data: 'created_at', name: 'created_at' },
        {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
    });
  });
</script>
@stop
