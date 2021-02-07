@extends('site.layouts.app')

@section('content')
<section class="order-process order-process-step-1 mt-5">
    <div class="container">
        <div class="row">
            <div class="@if($products->count()) col-12 col-md-9 @else col-lg-12 @endif">
                <h4 class="mb-3 main-color font-30 text-center mb-4">
                    <i class="fas fa-shopping-cart"></i> {{ trans('site.msg.cart_msg') }}
                </h4>

                @include('user.partials.checkout.steps')

                <div class="table-responsive">
                    <table class="table table-borderless cart-items-list">
                        <thead>
                            <tr>
                                <th scope="col">{{ trans('site.photo') }}</th>
                                <th scope="col">{{ trans('site.details') }}</th>
                                <th scope="col">{{ trans('site.actions.name') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($products->count())
                            @foreach ($products as $item)
                            @if($item->associatedModel == "App\Models\Product\Product" && $product = $item->model)
                            <tr>
                                <td>
                                    <div class="product-photo">
                                        <img src="{{ $product->firstImage() }}" alt="dummy">
                                    </div>
                                </td>
                                <td>
                                    <div class="product-details">
                                        <h6 class="font-16 text-capitalize main-color font-weight-bold">
                                            {{ $product->price}}
                                        </h6>
                                        <h5
                                            class="h6 font-weight-bold main-color primary-color d-flex align-items-center">
                                            @if($product->hasDiscount())
                                            <span class="badge badge-danger badge-pill  main-bg-color ml-2">
                                                {{ trans('site.discount.percent' , ['discount' => $product->discount_percent]) }}
                                            </span>
                                        </h5>
                                        @endif
                                        @if(count($item->options) == 2)
                                        @php
                                        $options = $item->options[0];
                                        $values = $item->options[1];
                                        @endphp
                                        <ul class="list-unstyled font-12">
                                            @foreach ($options as $option)
                                            <li>
                                                {{ $option['name'] ?? "" }} :
                                                @foreach ($values as $valueData)
                                                @foreach ($valueData as $value)
                                                <span class="primary-color">{{ $value['name'] }}</span> ,
                                                @endforeach
                                                @endforeach
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @livewire('cart-item-counter', ['rowId' => $item->rowId , 'max' => $product->amount])
                                </td>
                                <td>
                                    <div class="actions">
                                        <form action="{{ route('user.cart.remove' , $item->rowId) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="secondary-color font-13 delete-cart-btn btn">
                                                <i class="far fa-times-circle"></i> {{ trans('site.remove') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            @endif
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3" class="text-center"> {{ trans('site.cart.is_empty') }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {{-- @if($products->count())
                    <button class="btn btn-outline-danger w-100 rounded" onclick="location.reload()">
                        <i class="fas fa-sync-alt"></i> {{ trans('site.continue') }}
                    </button>
                    @endif --}}
                </div>
            </div>

            @if($products->count())
            <div class="col-12 col-md-3">
                <div class="border rounded p-3 order-summery">
                    <h4 class="text-center mb-3 font-18 font-weight-bold main-color">
                        {{ trans('order.summery') }}
                    </h4>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between lh-sm mb-2">
                            <span class="my-0 font-15 text-capitalize">{{ trans('order.total_before') }} </span>
                            <span class="font-12">
                                {{ config('app.currency') }}
                                {{ Cart::priceTotal() }}
                            </span>
                        </li>


                        @if(Cart::discount() > 0.0)
                        <li class="d-flex justify-content-between lh-sm mb-2">
                            <span class="my-0 font-15 text-capitalize">{{ trans('order.discount') }}</span>
                            <span class="font-12">
                                {{ config('app.currency') }}
                                -{{ Cart::discount() }}
                            </span>
                        </li>
                        @endif


                        @if((float) Cart::tax() > 0.0)
                        <li class="d-flex justify-content-between lh-sm mb-2">
                            <span class="my-0 font-15 text-capitalize">{{ trans('order.subtotal') }} </span>
                            <span class="font-12">
                                {{ config('app.currency') }}
                                {{ Cart::subtotal() }}
                            </span>
                        </li>
                        <li class="d-flex justify-content-between lh-sm mb-2">
                            <span class="my-0 font-15 text-capitalize">{{ trans('order.tax') }} </span>
                            <span class="font-12">
                                {{ config('app.currency') }}
                                {{ Cart::tax() }}
                            </span>
                        </li>
                        @endif

                        <li class="border-top pt-2 d-flex justify-content-between border-bottom-0">
                            <span class="font-15">{{ trans('order.total_after') }} </span>
                            <span class="font-12 ">
                                {{ config('app.currency') }}
                                {{ Cart::total() }}
                            </span>
                        </li>
                        <li class="mt-3 text-center">
                            <form action="{{ route('user.checkout.checkout') }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm rounded-pill">{{ trans('order.submit') }}</button>
                            </form>
                        </li>
                    </ul>

                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
