<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Site\Faq;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:faq-create'])->only(['store', 'create']);
        $this->middleware(['permission:faq-read'])->only('index');
        $this->middleware(['permission:faq-update'])->only(['update', 'edit']);
        $this->middleware(['permission:faq-delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $faqs = Faq::latest();
            return DataTables::of($faqs)
                ->addIndexColumn()
                ->addColumn('action', function ($faq) {
                    $btn = auth()->user()->isAbleTo('faq-update') ? '<a href="' . route('admin.faq.edit', $faq) . '" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;' : "";
                    $btn .= auth()->user()->isAbleTo('faq-delete') ?
                        '<form action=" ' . route("admin.faq.destroy", $faq) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        ' . method_field('delete') . '
                        <button type="submit" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                            Delete Faq
                        </button>
                    </form>
                    ' : "";
                    return $btn;
                })
                ->editColumn('body', function ($faq) {
                    return str_limit($faq->body);
                })
                ->editColumn('created_at', function ($faq) {
                    return $faq->created_at->diffForHumans();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $faq = Faq::create($request->validated());
        return redirect(route('admin.faq.index'))->withSuccess("Faq created succfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $faq->update($request->validated());
        return back()->withSuccess("Faq Updated succfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect(route('admin.faq.index'))->withSuccess("Faq Deleted succfully");
    }
}
