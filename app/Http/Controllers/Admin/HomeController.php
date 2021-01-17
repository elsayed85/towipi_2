<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePersonalInfo;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        auth()->user()->updatePassword($request->new_password);
        return back()->withSuccess('Password updated succfully');
    }

    public function updateInfo(UpdatePersonalInfo $request)
    {
        auth()->user()->update($request->validated());
        return back()->withSuccess('Your Info Updated Succfully');
    }
}
