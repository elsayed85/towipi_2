@extends('site.layouts.app')

@section('content')
<section class="user-profile user-wishlist mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('user.partials.sidebar')
            </div>
            <div class="col-12 col-md-8">
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
                            @forelse ($wishlist as $el)
                            @php
                            $product = $el->product;
                            $fisrtImageUrl = $product->firstImage();
                            @endphp
                            <tr>
                                <td>
                                    <div class="product-photo">
                                        <img src="{{ $fisrtImageUrl }}" alt="dummy">
                                    </div>
                                </td>
                                <td>
                                    <div class="product-details">
                                        <h6 class="font-12 text-capitalize main-color font-weight-bold">
                                            {{ $product->title }}
                                        </h6>
                                        <h5
                                            class="h6 font-weight-bold main-color primary-color d-flex align-items-center font-14">
                                            EGP 5.00
                                            <span class="badge badge-danger badge-pill  main-bg-color ml-2">
                                                -25% off
                                            </span>
                                        </h5>

                                    </div>
                                </td>
                                <td>
                                    <div class="actions ">
                                        <form action="{{ route('user.wishlist.destroy' , $el) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn mb-1 secondary-color font-12 mr-2" style="
                                            padding: 0!important;
                                            margin: 0!important;
                                        ">
                                                <i class="fas fa-trash-alt  main-color"></i> {{ trans('site.remove') }}
                                            </button>
                                        </form>
                                        <br>
                                        <form action="{{ route('user.wishlist.moveToCart' , $el) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn mb-1 secondary-color font-12 mr-2" style="
                                            padding: 0!important;
                                            margin: 0!important;
                                        ">
                                                <i class="fas fa-shopping-cart main-color"></i>
                                                {{ trans('site.add_to_cart') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">{{ trans('site.user.empty_wishlist') }}</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                    {{ $wishlist->render() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
