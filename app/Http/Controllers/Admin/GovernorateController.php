<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GovernorateRequest;
use App\Models\General\Country;
use App\Models\General\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $governorates = Governorate::latest()->with(['country'])->withCount(['addresses', 'shippingAddresses'])->paginate(10);
        return view('admin.governorates.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.governorates.create' , get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GovernorateRequest $request)
    {
        $gov = Governorate::create($request->validated());
        return redirect(route('admin.governorate.index'))->withSuccess("Governorate {$gov->name_en} added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Governorate $governorate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Governorate $governorate)
    {
        $countries = Country::all();
        return view('admin.governorates.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GovernorateRequest $request, Governorate $governorate)
    {
        $governorate->update($request->validated());
        return back()->withSuccess("governorate {$governorate->name_en} updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Governorate $governorate)
    {
        $governorate->delete();
        return back()->withSuccess("governorate {$governorate->name_en} deleted");
    }
}
