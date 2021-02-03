@extends('site.layouts.app')

@section('content')
<section class="order-process order-process-step-1 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-9">
                <h4 class="mb-3 main-color font-30 text-center mb-4">
                    <i class="fas fa-map-marker-alt"></i> Your Shipping Address
                </h4>

                @include('user.partials.checkout.steps')

                <div class="mt-4 address">
                    <div class="text-right mb-3">
                        <a id="add-new-address" href="#" class="btn btn-danger btn-sm rounded-pill font-12">
                            <i class="fas fa-plus mr-2"></i> {{ trans('site.add_new_addresss') }}
                        </a>
                    </div>
                    <ul class="list-unstyled address-list">
                        <form action="{{ route('user.checkout.add_new_address' , ['order' =>  $order]) }}" method="POST"
                            id="add_address_form">
                            @csrf
                            @foreach ($addresses as $address)
                            <li>
                                <div class="d-flex justify-content-between address-name-action">
                                    <label>
                                        <input name="address_id" value="{{ $address->id }}" type="radio" autocomplete="off"
                                            data-shipping-price="{{ $address->governorate->shipping_price->getAmount()  }}">
                                        {{ $address->title }}
                                    </label>
                                </div>
                            </li>
                            @endforeach
                            <li class="hidden-address">
                                <ul class="list-unstyled address-list">
                                    <li class="hidden-address" @if(!$errors->any()) style="display: none" @endif>
                                        <div class="form-fields">
                                            <div class="row">
                                                <!-- .form-group -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="first_name">{{ trans('site.address_info.fname') }}</label>
                                                        <input type="text" class="form-control" id="first_name"
                                                            aria-describedby="helpId" placeholder="" autocomplete="off"
                                                            name="fname" value="{{ old('fname') }}">
                                                        @error('fname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- ./form-group -->
                                                <!-- .form-group -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="last_name">{{ trans('site.address_info.lname') }}</label>
                                                        <input type="text" class="form-control" id="last_name"
                                                            aria-describedby="helpId" placeholder="" autocomplete="off"
                                                            name="lname" value="{{ old('lname') }}">
                                                        @error('lname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./form-group -->
                                                <!-- .form-group -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="phone">{{ trans('site.address_info.phone1') }}</label>
                                                        <input type="text" class="form-control" id="phone"
                                                            aria-describedby="helpId" placeholder="" autocomplete="off"
                                                            name="phone_1" value="{{ old('phone_1') }}">
                                                        @error('phone_1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./form-group -->
                                                <!-- .form-group -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="optional_phone">{{ trans('site.address_info.phone2_additional') }}</label>
                                                        <input type="text" class="form-control" id="optional_phone"
                                                            aria-describedby="helpId" placeholder="" autocomplete="off"
                                                            name="phone_2" value="{{ old('phone_2') }}">
                                                        @error('phone_2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./form-group -->
                                                <!-- .form-group -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="country">{{ trans('site.address_info.country') }}</label>
                                                        <select class="form-control" id="country" name="country_id">
                                                            <option selected>Select one</option>
                                                            @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}" @if(old('country_id' ,
                                                                auth()->user()->country_id) == $country->id)
                                                                selected @endif>{{ $country->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('country_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./form-group -->
                                                <!-- .form-group -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="governorates">{{ trans('site.address_info.governorate') }}</label>
                                                        <select class="form-control" id="governorates"
                                                            name="governorate_id">
                                                            @foreach (auth()->user()->country->governorates as $gov)
                                                            <option value="{{ $gov->id }}"
                                                                data-shipping-price="{{ $gov->shipping_price->getAmount() }}"
                                                                @if(old('governorate_id')==$gov->id)
                                                                selected @endif>
                                                                {{ $gov->name_en }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('governorate_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./form-group -->
                                                <!-- .form-group -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="city">{{ trans('site.address_info.city') }}</label>
                                                        <input type="text" class="form-control" id="city"
                                                            aria-describedby="helpId" placeholder="" autocomplete="off"
                                                            name="city" value="{{ old('city') }}">
                                                        @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./form-group -->
                                                <!-- .form-group -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="address_area">{{ trans('site.address_info.address_area') }}</label>
                                                        <textarea name="name" class="form-control"
                                                            id="address_area"
                                                            rows="3">{{ old('address_name') }}</textarea>
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./form-group -->
                                                <!-- .form-group -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="shipping_notes">{{ trans('site.address_info.shipping_notes') }}</label>
                                                        <textarea name="notes" class="form-control" id="shipping_notes"
                                                            rows="3">{{ old('notes') }}</textarea>
                                                        @error('notes')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./form-group -->
                                                <div class="col-12">
                                                    <button class="btn btn-sm btn-danger mr-2 rounded-pill font-14"
                                                        type="submit"><i
                                                            class="fas fa-save mr-1"></i>{{ trans('site.save') }}</button>
                                                    <button id="cancel-address"
                                                        class="btn btn-sm btn-outline-danger rounded-pill font-14">
                                                        <i class="fas fa-times mr-1"></i>{{ trans('site.cancel') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </form>
                    </ul>
                    <hr>
                    <div class="d-flex justify-content-between flex-wrap">

                        <a href="{{ route('user.checkout.index') }}">
                            <button class="btn btn-sm btn-info mr-2 rounded-pill font-14">
                                <i class="fas fa-chevron-left mr-1"></i> Back to cart
                            </button>
                        </a>

                        <button class="btn btn-sm btn-outline-info rounded-pill font-14"
                            onclick="document.getElementById('add_address_form').submit()">
                            Proceed to payment <i class="fas fa-chevron-right ml-1"></i>
                        </button>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-outline-info rounded-pill font-14"
                            data-toggle="modal" data-target="#exampleModal">
                            Launch shipping errors
                        </button>
                    </div>

                </div>
            </div>

            <div class="col-12 col-md-4 col-lg-3">
                <div class="border rounded p-3 order-summery">
                    <h4 class="text-center mb-3 font-18 font-weight-bold main-color">
                        Order Summary
                    </h4>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between lh-sm mb-2">
                            <span class="my-0 font-15 text-capitalize">{{ trans('order.total_before') }}</span>
                            <span class="font-12"
                                data-total="{{ $order->total->getAmount() }}">{{ $order->total }}</span>
                        </li>
                        <li class="d-flex justify-content-between lh-sm mb-2">
                            <span class="my-0 font-15 text-capitalize">Shipping cost</span>
                            <span class="font-12" id="shipping_cost">--</span>
                        </li>
                        <li class="d-flex justify-content-between lh-sm mb-2">
                            <span class="my-0 font-15 text-capitalize">Discount</span>
                            <span class="font-12" id="discount">--</span>
                        </li>
                        <li class="border-top pt-2 d-flex justify-content-between border-bottom-0">
                            <span class="font-15">Total </span>
                            <span class="font-12"
                                data-total="{{ $order->total->getAmount() }}">{{ $order->total }}</span>
                        </li>
                        <li class=" text-center">
                            <form action="">
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
                                        placeholder="">
                                    <button class="btn btn-info btn-sm rounded-pill font-11 w-100 mt-2">
                                        Apply Coupon
                                    </button>
                                    <small id="helpId" class="form-text text-muted font-11">You can apply only
                                        one
                                        coupon</small>
                                </div>

                            </form>
                        </li>

                    </ul>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $('#country').on('change',function(e) {
            var country_id = e.target.value;
            $.ajax({

                url:"{{ route('user.get_governorates') }}",
                type:"POST",
                data: {
                    country_id: country_id
                },
                success:function (data) {
                    $('#governorates').empty();
                    $.each(data.governorates,function(index,governorate){
                        $('#governorates').append('<option value="'+governorate.id+'">' + governorate.name_en +'</option>');
                    })
                }
            })
        });

    });
</script>
@endsection
