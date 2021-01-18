@extends('adminlte::page')

@section('title', 'Pages')

@section('content_header')
<h1 class="m-0 text-dark">Pages</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="pages" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
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
    $('#pages').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.pages.index')}}",
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf' , 'print',
        @if(auth()->user()->isAbleTo('pages-create'))
            {
                text: 'Add New Page',
                action: function ( e, dt, node, config ) {
                    location.replace("{{ route('admin.pages.create') }}");
                }
            }
        @endif
    ],
      columns: [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'created_at', name: 'created_at' },
        {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
    });
  });
</script>
@stop
