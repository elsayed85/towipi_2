@extends('admin.app')
@section('title', 'Page')
@section('content')
     <div class="container-fluid ">
        @if(session()->has('success'))
            <x-alert-component type="success" message="{{session('success')}}"></x-alert-component>
        @endif
        <form autocomplete="off" method="POST" action="{{ route('pages.update', $page) }}"  enctype="multipart/form-data" >
            @csrf
            @method('PATCH')
            <div class="row">
                <!-- .col-md-6 -->
                <div class="col-12 col-md-3 ">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4  h-100">
                        <div class="card-header py-3">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Create Page</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="author">Page Name</label>
                                        <input type="text"
                                               name="author"
                                               class="form-control"
                                               id="author"
                                               value="{{ $page->author }}"
                                               autocomplete="off"/>
                                        @error('author')
                                        <small class="form-text text-danger font-weight-bold">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- .col-md-6 -->
                <div class="col-12 col-md-9 h-100">
                    <div class="card shadow">
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
                                    @forelse(locales() as $key)
                                        <li class="nav-item">
                                            <a class="nav-link @if($loop->first) active @endif"
                                               id="custom-{{$key}}-below-home-tab"
                                               data-toggle="pill"
                                               href="#tab-{{ $key }}"
                                               role="tab"
                                               aria-controls="custom-content-below-home"
                                               aria-selected="true">
                                                {{ localesAliases($key) }}
                                            </a>
                                        </li>
                                    @empty
                                        Don't found any language to show it
                                    @endforelse
                                </ul>


                                <div class="tab-content" id="custom-content-below-tabContent">
                                    @forelse(locales() as $key)
                                        <div class="tab-pane fade @if($loop->first) active show @endif"
                                             id="tab-{{$key}}"
                                             role="tabpanel"
                                             aria-labelledby="tab-{{$key}}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mt-3">
                                                <!-- .col-12 -->
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group @error($key.'.title') has-danger @enderror">
                                                        <label class="form-control-label"
                                                               for="input-name">{{ __('Title') }} <span class="text-danger">*</span> </label>
                                                        <input
                                                            type="text"
                                                            name="{{ $key }}[title]"
                                                            id="input-author-en"
                                                            class="form-control form-control-alternative @error($key.'.title') is-invalid @enderror"
                                                            autofocus
                                                            value="{{ optional($page->translate($key))->title }}"
                                                            @if($loop->first) required @endif >
                                                        @error($key.'.title')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./col-12 -->
                                                <!-- .col-12 -->
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group @error($key.'.body') has-danger @enderror">
                                                        <label class="form-control-label"
                                                               for="input-name">{{ __('Body') }} <span class="text-danger">*</span>  </label>
                                                        <textarea class="ckeditor form-control form-control-alternative @error($key.'.body') is-invalid @enderror"
                                                                  name="{{ $key }}[body]"
                                                                  @if($loop->first) required @endif
                                                                  rows="6"
                                                        >{{ optional($page->translate($key))->body != null ? optional($page->translate($key))->body : old($key.'.body') }}</textarea>
                                                        @error('body')
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
            </div>
            <div class="mt-4 text-right">
                <button type="submit" class="btn btn-success btn-md">Update</button>
            </div>
        </form>
    </div>

@endsection



{{-- ./author-data --}}
