@extends('site.layouts.app')
@section('title' , $page->title)
@section('content')
<section class="page-title mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    <span>{{ $page->title }}</span>
                </h1>
            </div>
        </div>
    </div>
</section>

<section class="about mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                {!! $page->body !!}
            </div>
        </div>
    </div>
</section>
@endsection
