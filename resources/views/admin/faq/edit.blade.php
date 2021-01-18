@extends('adminlte::page')

@section('title', 'Faq')

@section('content_header')
<h1 class="m-0 text-dark">Faq</h1>
@stop

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            Edit Faq : {{ $faq->title }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.faq.update' , $faq) }}" method="post">
                @csrf
                @method('patch')
                <div class="transliation-tabs">
                    <ul class="nav nav-pills " id="custom-content-below-tab" role="tablist">
                        @foreach(locales() as $key)
                        <li class="nav-item">
                            <a class="nav-link @if($loop->first) active @endif" id="custom-{{$key}}-below-home-tab"
                                data-toggle="pill" href="#tab-{{ $key }}" role="tab"
                                aria-controls="custom-content-below-home" aria-selected="true">
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
                                                    <div class="form-group @error($key.'.title') has-danger @enderror">
                                                        <label class="form-control-label"
                                                            for="input-name">{{ __('Title')  . " ({$key})"}}
                                                            @if($loop->first) <span class="text-danger">*</span> @endif
                                                        </label>

                                                        <input type="text" name="{{ $key }}[title]"
                                                            id="input-author-{{ $key }}"
                                                            class="form-control form-control-alternative @error($key.'.title') is-invalid @enderror"
                                                            value="{{ optional($faq->translate($key))->title }}"
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
                                <div class="col-12 col-md-3 ">
                                    <div class="card mb-4  h-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group @error($key.'.body') has-danger @enderror">
                                                        <label class="form-control-label"
                                                            for="input-name">{{ __('Body')  . " ({$key})"}}
                                                            @if($loop->first) <span class="text-danger">*</span> @endif
                                                        </label>

                                                        <textarea type="text" name="{{ $key }}[body]"
                                                            id="input-author-{{ $key }}"
                                                            class="form-control form-control-alternative @error($key.'.body') is-invalid @enderror"
                                                            autofocus @if($loop->first) required @endif
                                                        >{{ old($key . '.body' , optional($faq->translate($key))->body)  }}</textarea>

                                                        @error($key.'.body')
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
                            </div>

                        </div>

                        @endforeach
                    </div>

                </div>
                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="light" label="Add" />
            </form>
        </div>
    </div>
</div>
@stop
