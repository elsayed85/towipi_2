@extends('site.layouts.app')

@section('content')
<section class="user-profile user-wishlist mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('user.partials.sidebar')
            </div>
            <div class="col-12 col-md-8">

                <div class="mt-4 address">
                    <div class="text-right mb-3">
                        <a id="add-new-address" href="#" class="btn btn-danger btn-sm rounded-pill font-12">
                            <i class="fas fa-plus mr-2"></i> {{ trans('site.add_new_addresss') }}
                        </a>
                    </div>
                    <ul class="list-unstyled address-list">
                        @foreach ($addresses as $address)
                        <li>
                            <div class="d-flex justify-content-between address-name-action">
                                <label>
                                    {{ $address->title }}
                                </label>
                                <form action="{{ route('user.address.destroy' , $address) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn mb-1 secondary-color font-12 mr-2" style="
                                    padding: 0!important;
                                    margin: 0!important;
                                    ">
                                        <i class="fas fa-trash-alt main-color font-24"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                        <hr class="mt-2 mb-3">
                        @endforeach
                    </ul>
                    <form action="{{ route('user.address.store') }}" method="POST">
                        @csrf
                        <ul class="list-unstyled address-list">
                            <li class="hidden-address" @if(!$errors->any()) style="display: none" @endif>
                                <div class="d-flex justify-content-between address-name-action">
                                    <label>
                                        <input name="address" type="radio" autocomplete="off">
                                        {{ trans('site.address_info.new') }}
                                    </label>

                                </div>
                                <div class="form-fields">
                                    <div class="row">
                                        <!-- .form-group -->
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="title">{{ trans('site.address_info.title') }}</label>
                                                <input type="text" class="form-control" id="title"
                                                    aria-describedby="helpId" placeholder="" autocomplete="off"
                                                    name="title" value="{{ old('title') }}">
                                                @error('title')
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
                                                <label for="first_name">{{ trans('site.address_info.fname') }}</label>
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
                                                <label for="last_name">{{ trans('site.address_info.lname') }}</label>
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
                                                <label for="phone">{{ trans('site.address_info.phone1') }}</label>
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
                                                <label for="country">{{ trans('site.address_info.country') }}</label>
                                                <select class="form-control" id="country" name="country_id">
                                                    <option selected>Select one</option>
                                                    @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" @if(old('country_id' , auth()->
                                                        user()->country_id) == $country->id)
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
                                                <select class="form-control" id="governorates" name="governorate_id">
                                                    @foreach (auth()->user()->country->governorates as $gov)
                                                    <option value="{{ $gov->id }}" @if(old('governorate_id')==$gov->id)
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
                                                <textarea name="address_name" class="form-control" id="address_area"
                                                    rows="3">{{ old('address_name') }}</textarea>
                                                @error('address_name')
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
                                            <button class="btn btn-sm btn-danger mr-2 rounded-pill font-14"><i
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
                    </form>
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
