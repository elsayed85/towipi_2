@extends('adminlte::page')

@section('title', 'Countries')

@section('content_header')
<h1 class="m-0 text-dark">Countries</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="Countries" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>Users count</th>
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
    $('#Countries').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.country.index')}}",
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf' , 'print',
        @if(auth()->user()->isAbleTo('country-create'))
            {
                text: 'Add New Country',
                action: function ( e, dt, node, config ) {
                    location.replace("{{ route('admin.country.create') }}");
                }
            }
        @endif
    ],
      columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'users_count', name: 'users_count' ,  orderable: false, searchable: false },
        {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
    });
  });
</script>
@stop
