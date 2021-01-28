<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\User\UpdatePersonalInfo;
use App\Models\General\Country;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('user.profile', get_defined_vars());
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        auth()->user()->updatePassword($request->new_password);
        return back()->withSuccess(trans('site.msg.password_updated'));
    }

    public function updateInfo(UpdatePersonalInfo $request)
    {
        if ($request->has('email') && $request->email != auth()->user()->email) {
            auth()->user()->update(['email_verified_at' => null]);
            auth()->user()->sendEmailVerificationNotification();
        }
        auth()->user()->update($request->validated());
        return back()->withSuccess(trans('site.msg.info_updated'));
    }
}
