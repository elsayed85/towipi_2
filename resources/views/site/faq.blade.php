@extends('site.layouts.app')
@section('title' , trans('site.faq'))
@section('content')
<section class="page-title mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    <span>{{ trans('site.faq') }}</span>
                </h1>
            </div>
        </div>
    </div>
</section>

<section class="about mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <div class="accordion" id="faqExample">
                        @foreach ($faqs as $faq)
                        <div class="card">
                            <div class="card-header p-2" id="heading{{ $faq->id }}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link @if(!$loop->first) collapsed @endif" @if(!$loop->first)
                                        aria-expanded="false" @endif type="button" data-toggle="collapse"
                                        data-target="#collapse{{ $faq->id }}" aria-controls="collapse{{ $faq->id }}">
                                        {{ $faq->title }}
                                    </button>
                                </h5>
                            </div>

                            <div id="collapse{{ $faq->id }}" class="collapse @if($loop->first) show @endif" aria-labelledby="heading{{ $faq->id }}"
                                data-parent="#faqExample">
                                <div class="card-body">
                                    {{ $faq->body }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $faqs->render() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
