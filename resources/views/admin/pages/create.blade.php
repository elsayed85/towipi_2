@extends('adminlte::page')

@section('title', 'Pages')

@section('content_header')
<h1 class="m-0 text-dark">Pages</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            Add New Page
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pages.store') }}" method="post">
                @csrf
                <x-adminlte-input name="slug" label="Url Of The Page" placeholder="Url Of The Page"
                    label-class="text-lightblue" value="{{ old('slug') }}">
                </x-adminlte-input>

                @foreach(locales() as $key)
                <div class="col-12 col-sm-12">
                    <div class="form-group @error($key.'.title') has-danger @enderror">
                        <label class="form-control-label" for="input-name">{{ __('Title')  . " ({$key})"}}
                            @if($loop->first) <span class="text-danger">*</span> @endif
                        </label>

                        <input
                            type="text"
                            name="{{ $key }}[title]"
                            id="input-author-{{ $key }}"
                            class="form-control form-control-alternative @error($key.'.title') is-invalid @enderror"
                            autofocus  @if($loop->first) required @endif
                        >

                        @error($key.'.title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>
                @endforeach

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Add" />
            </form>
        </div>
    </div>
</div>
@stop
