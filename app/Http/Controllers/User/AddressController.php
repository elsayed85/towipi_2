<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddressRequest;
use App\Models\Address;
use App\Models\General\Country;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $addresses = auth()->user()->addresses()->latest()->paginate(10);
        return view('user.address', get_defined_vars());
    }

    public function store(AddressRequest $request)
    {
        auth()->user()->addresses()->create($request->validated());
        return back()->withSuccess(trans('site.msg.address_addedd'));
    }

    public function update(AddressRequest $request, Address $address)
    {
        abort_unless($address->user_id == auth()->id(), 403);
        auth()->user()->addresses()->create($request->validated());
        return back()->withSuccess(trans('site.msg.address_addedd'));
    }

    public function destroy(Address $address)
    {
        abort_unless($address->user_id == auth()->id(), 403);
        $address->delete();
        return back()->withSuccess(trans('site.msg.address_deleted'));
    }
}
