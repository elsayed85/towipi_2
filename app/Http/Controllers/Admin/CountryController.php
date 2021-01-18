<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Models\General\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:country-create'])->only(['store', 'create']);
        $this->middleware(['permission:country-read'])->only('index');
        $this->middleware(['permission:country-update'])->only(['update', 'edit']);
        $this->middleware(['permission:country-delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $countries = Country::withCount(['users']);
            return DataTables::of($countries)
                ->addIndexColumn()
                ->addColumn('action', function ($country) {
                    $btn = auth()->user()->isAbleTo('country-update') ? '<a href="' . route('admin.country.edit', $country) . '" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;' : "";
                    $btn .= auth()->user()->isAbleTo('country-delete') ?
                    '<form action=" ' . route("admin.country.destroy", $country) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        ' . method_field('delete') . '
                        <button type="submit" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                            Delete country
                        </button>
                    </form>
                    ' : "";
                    return $btn;
                })
                ->editColumn('users_count', function ($country) {
                    return $country->users_count;
                })
                ->rawColumns(['action' , 'users_count'])
                ->make(true);
        }
        return view('admin.country.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $country = Country::create($request->validated());
        return redirect(route('admin.country.index'))->withSuccess("country {$country->name} created succfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('admin.country.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        return back()->withSuccess("country {$country->name} Updated succfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect(route('admin.country.index'))->withSuccess("country {$country->title} Deleted succfully");
    }
}
