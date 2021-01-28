@extends('site.layouts.app')

@section('content')
<section class="user-profile mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('user.partials.sidebar')
            </div>
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h6 class="mb-3 text-capitalize font-weight-600 main-color">
                            {{ trans('site.user.profile.edit_info') }}</h6>
                        <form action="{{ route('user.profile.update_info') }}" method="POST">
                            @method('put')
                            @csrf
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="first_name">{{ trans('site.fname') }}</label>
                                <input type="text" class="form-control" id="first_name" aria-describedby="helpId"
                                    placeholder="" autocomplete="off" name="fname" value="{{ old('fname' , auth()->user()->fname) }}">
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- ./form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="last_name">{{ trans('site.lname') }}</label>
                                <input type="text" class="form-control" id="last_name" aria-describedby="helpId"
                                    placeholder="" autocomplete="off" name="lname" value="{{ old('lname' , auth()->user()->lname) }}">
                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- ./form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="email">{{ trans('site.email') }}</label>
                                <input type="email" class="form-control" id="email" aria-describedby="helpId"
                                    placeholder="" autocomplete="off" name="email" value="{{ old('email' , auth()->user()->email) }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- ./form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="phone">{{ trans('site.phone_number') }}</label>
                                <input type="text" class="form-control" id="phone" aria-describedby="helpId"
                                    placeholder="" autocomplete="off" name="phone" value="{{ old('phone' , auth()->user()->phone) }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- ./form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="country">{{ trans('site.country') }}</label>
                                <select class="form-control" id="country" name="country_id">
                                    <option selected>Select one</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @if(old('countr_id' , auth()->user()->country_id) == $country->id)
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
                            <!-- ./form-group -->
                            <button class="btn btn-danger btn-sm rounded-pill mt-2">{{ trans('site.update') }}</button>
                        </form>
                    </div>
                    <div class="col-12 col-md-6">
                        <h6 class="mb-3 text-capitalize font-weight-600 main-color">
                            {{ trans('site.user.profile.edit_password') }}</h6>
                        <form action="{{ route('user.profile.update_password') }}" method="POST">
                            @method('put')
                            @csrf
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="current_password">{{ trans('site.current_pass') }}</label>
                                <input type="password" class="form-control" id="current_password"
                                    aria-describedby="helpId" placeholder="" autocomplete="off" name="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- ./form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="new_password">{{ trans('site.new_pass') }}</label>
                                <input type="password" class="form-control" id="new_password" aria-describedby="helpId"
                                    placeholder="" autocomplete="off" name="new_password">
                                @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- ./form-group -->
                            <!-- .form-group -->
                            <div class="form-group">
                                <label for="confirm_password">{{ trans('site.confirm_pass') }}</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    aria-describedby="helpId" placeholder="" autocomplete="off"
                                    name="new_password_confirmation">

                                @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- ./form-group -->

                            <button class="btn btn-danger btn-sm rounded-pill mt-2">{{ trans('site.update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
