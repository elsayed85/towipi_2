<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UpdateInfoRequest;
use App\Models\General\Country;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users-read'])->only(['index', 'show']);
        $this->middleware(['permission:admins-update'])->only(['update', 'edit', 'toggleActivate']);
        $this->middleware(['permission:admins-delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->with(['country'])->withCount(['orders'])->paginate(10);
        return view('admin.users.index', get_defined_vars());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load([
            'orders' => function ($query) {
                return $query->latest();
            },
            'payments' => function ($query) {
                return $query->latest();
            },
            'addresses' => function ($query) {
                return $query->with(['governorate'])->latest();
            },
            'complaints' => function ($query) {
                return $query->with(['order', 'product.translations'])->latest();
            },
            'rates' => function ($query) {
                return $query->with(['product.translations'])->latest();
            }
        ]);
        return view('admin.users.show', get_defined_vars());
    }

    public function edit(User $user)
    {
        $countries = Country::all();
        return view('admin.users.edit', get_defined_vars());
    }

    public function update(UpdateInfoRequest $request, User $user)
    {
        $password = !is_null($request->password) ? ["password" => Hash::make($request->password)] : [];
        $user->update($request->only(['email', 'fname', 'lname', 'country_id', 'phone']) + $password);
        return back()->withSuccess("user {$user->name} info updated succfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('admin.users.index'))->withSuccess("user {$user->name} deleted succfully");
    }

    public function toggleActivate(User $user)
    {
        $user->toggleActivate();
        $status = $user->is_active ? "Active" : "Not Active";
        return back()->withSuccess("user {$user->name} is {$status} now");
    }
}
