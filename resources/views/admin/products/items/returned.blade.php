@extends('adminlte::page')

@section('title', 'Returned Products')

@section('content_header')
<h1 class="m-0 text-dark">Returned Products</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="admins" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>product</th>
                    <th>order</th>
                    <th>message</th>
                    <th>status</th>
                    <th>Created</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        @if($item->product)
                        <a
                            href="{{ route('admin.product.show' , $item->product) }}">{{ optional($item->product)->title }}</a>
                        @endif
                    </td>
                    <td> <a href="{{ route('admin.orders.show' , $item->order) }}">{{ $item->order->order_number }}</a>
                    </td>
                    <td>{{ $item->message }}</td>
                    <td>{{ $item->status_str }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        @if(!$item->isAccepted())
                        <form style="display: inline-block;"
                            action="{{ route('admin.product.returned.change_state' , ['item' => $item]) }}"
                            method="post">
                            @csrf
                            @method("patch")
                            <input type="hidden" name="action_name" value="accept">
                            <button class="btn btn-default" type="submit">Accept</button>
                        </form>
                        @endif

                        @if(!$item->isRejected())
                        <form style="display: inline-block;"
                            action="{{ route('admin.product.returned.change_state' , ['item' => $item]) }}"
                            method="post">
                            @csrf
                            @method("patch")
                            <input type="hidden" name="action_name" value="reject">
                            <button class="btn btn-default" type="submit">Reject</button>
                        </form>
                        @endif

                        @if(!$item->isWaitingForAccept())
                        <form style="display: inline-block;"
                            action="{{ route('admin.product.returned.change_state' , ['item' => $item]) }}"
                            method="post">
                            @csrf
                            @method("patch")
                            <input type="hidden" name="action_name" value="waiting">
                            <button class="btn btn-default" type="submit">Waiting</button>
                        </form>
                        @endif

                        <form style="display: inline-block;"
                            action="{{ route('admin.product.returned.destroy' , ['item' => $item]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->render() }}
    </div>
</div>
@stop
