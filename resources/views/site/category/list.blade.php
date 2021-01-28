@extends('site.layouts.app')

@section('content')
<section class="categoires mt-5">
    <div class="container">
        <div class="row">
            @forelse ($categories as $category)
            <!-- .col-md-4 -->
            <div class="col-12 col-md-4 text-center">
                <div class="category-box">
                    <a href="#">
                        @if(!is_null($category->icon))
                        <img class="rounded-circle" src="{{ $category->icon }}" alt="photo">
                        @endif
                        <h4 class="mt-3 font-weight-bold font-30 main-color">{{ $category->name }}</h4>
                    </a>
                </div>
            </div>
            <!-- ./col-md-4 -->
            @empty
            {{ trans('site.no_categories_found') }}
            @endforelse
            {{ $categories->render() }}
        </div>
    </div>
</section>
@endsection
