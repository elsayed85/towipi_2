@extends('adminlte::page')

@section('title', 'Faq')

@section('content_header')
<h1 class="m-0 text-dark">Faq
    @permission('faq-create')
     | <a href="{{ route('admin.faq.create') }}" class="btn btn-info">Add New</a>
    @endpermission
</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="faqs" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>title</th>
                    <th>Body</th>
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
    $('#faqs').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.faq.index')}}",
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf' , 'print',
        @if(auth()->user()->isAbleTo('faq-create'))
            {
                text: 'Add New Faq',
                action: function ( e, dt, node, config ) {
                    location.replace("{{ route('admin.faq.create') }}");
                }
            },
        @endif
        {
            text: 'Open All Faq',
            action: function ( e, dt, node, config ) {
                location.replace("{{ route('faq') }}");
            }
        }
    ],
      columns: [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'en.title' ,  orderable: false, searchable: false },
        { data: 'body', name: 'en.body' ,  orderable: false, searchable: false },
        { data: 'created_at', name: 'created_at' },
        {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
    });
  });
</script>
@stop
