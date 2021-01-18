@extends('adminlte::page')

@section('title', 'Pages')

@section('content_header')
<h1 class="m-0 text-dark">Pages</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            Edit Page : {{ $page->title }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pages.update' , $page) }}" method="post">
                @csrf
                @method('patch')
                <x-adminlte-input name="slug" label="Url Of The Page" placeholder="Url Of The Page"
                    label-class="text-lightblue" value="{{ old('slug' , $page->slug) }}">
                </x-adminlte-input>

                <div class="col-12 col-md-9 h-100">
                    <div class="card">
                        <div class="card-header py-3">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Translations</h6>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="transliation-tabs">
                                <ul class="nav nav-pills " id="custom-content-below-tab" role="tablist">
                                    @foreach(locales() as $key)
                                    <li class="nav-item">
                                        <a class="nav-link @if($loop->first) active @endif"
                                            id="custom-{{$key}}-below-home-tab" data-toggle="pill"
                                            href="#tab-{{ $key }}" role="tab" aria-controls="custom-content-below-home"
                                            aria-selected="true">
                                            {{ localesAliases($key) }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content" id="custom-content-below-tabContent">
                                    @forelse(locales() as $key)
                                    <div class="tab-pane fade @if($loop->first) active show @endif" id="tab-{{$key}}"
                                        role="tabpanel" aria-labelledby="tab-{{$key}}">
                                        @csrf
                                        <div class="row mt-3">
                                            <!-- .col-12 -->
                                            <div class="col-12 col-md-3 ">
                                                <div class="card mb-4  h-100">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12">
                                                                <div
                                                                    class="form-group @error($key.'.title') has-danger @enderror">
                                                                    <label class="form-control-label"
                                                                        for="input-name">{{ __('Title')  . " ({$key})"}}
                                                                        @if($loop->first) <span class="text-danger">*</span> @endif
                                                                    </label>

                                                                    <input type="text" name="{{ $key }}[title]"
                                                                        id="input-author-{{ $key }}"
                                                                        class="form-control form-control-alternative @error($key.'.title') is-invalid @enderror"
                                                                        value="{{ optional($page->translate($key))->title }}"
                                                                        autofocus @if($loop->first) required @endif
                                                                    >

                                                                    @error($key.'.title')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./col-12 -->
                                            <!-- .col-12 -->
                                            <div class="col-12 col-sm-12">
                                                <div class="form-group @error($key . '.body') has-danger @enderror">
                                                    <label class="form-control-label" for="input-name">{{ __('Body') }}
                                                        @if($loop->first) <span class="text-danger">*</span> @endif
                                                    </label>
                                                    <textarea
                                                        class="ckeditor form-control form-control-alternative @error($key.'.body') is-invalid @enderror"
                                                        name="{{ $key }}[body]" @if($loop->first) required @endif
                                                        rows="6"
                                                        >{{ old($key . '.body' , optional($page->translate($key))->body)  }}</textarea>
                                                    @error($key . '.body')
                                                    <small class="form-text text-danger">
                                                        {{ $message }}
                                                    </small>
                                                    @enderror

                                                </div>
                                            </div>
                                            <!-- ./col-12 -->
                                        </div>

                                    </div>

                                    @endforeach
                                </div>

                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>

                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Save" />
            </form>
            <form action="{{ route('admin.pages.destroy' , $page) }}" method="post" style="display: inline">
                @csrf
                @method('delete')
                <x-adminlte-button label="Danger" type="submit" label="Delete Page" theme="danger" icon="far fa-trash-alt" />
            </form>
            <x-adminlte-button  onclick="location.href='{{ route('page' , $page) }}'" label="Open" theme="success" icon="far fa-eye" />
        </div>
    </div>
</div>
@stop
