<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\General\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:pages-create'])->only(['store', 'create']);
        $this->middleware(['permission:pages-read'])->only('index');
        $this->middleware(['permission:pages-update'])->only(['update', 'edit']);
        $this->middleware(['permission:pages-delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pages = Page::latest();
            return DataTables::of($pages)
                ->addIndexColumn()
                ->addColumn('action', function ($page) {
                    $btn = auth()->user()->isAbleTo('pages-update') ? '<a href="' . route('admin.pages.edit', $page) . '" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;' : "";
                    $btn .= '<a href="' . route('page', $page) . '" class="show btn btn-primary btn-sm">Open</a>';
                    $btn .= auth()->user()->isAbleTo('pages-delete') ?
                        '<form action=" ' . route("admin.pages.destroy", $page) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        ' . method_field('delete') . '
                        <button type="submit" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                            Delete Page
                        </button>
                    </form>
                    ' : "";
                    return $btn;
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->diffForHumans();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->slug);
        dd($data);
        $page = Page::create($data);
        return redirect(route('admin.pages.index'))->withSuccess("page {$page->title}  created succfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
