<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminCrudRequest;
use App\Models\Permission;
use App\Models\Role;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $assignPermissions;

    public function __construct()
    {
        $this->assignPermissions = Config::get('laratrust.panel.assign_permissions_to_user');
        $this->middleware(['permission:admins-create'])->only(['store', 'create']);
        $this->middleware(['permission:admins-read'])->only('index');
        $this->middleware(['permission:admins-update'])->only(['update', 'edit']);
        $this->middleware(['permission:admins-delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $admins = User::whereRoleIs(['admin', 'super_admin'])->with(['roles'])->latest();
            return Datatables::of($admins)
                ->addIndexColumn()
                ->addColumn('action', function ($id) {
                    $btn = auth()->user()->isAbleTo('admins-update') ? '<a href="' . route('admin.admin.edit', $id) . '" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;' : "";
                    return $btn;
                })
                ->addColumn('roles', function ($user) {
                    return $user->roles->pluck('display_name');
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->diffForHumans();
                })
                ->rawColumns(['action', 'roles'])
                ->make(true);
        }
        return view('admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get(['id', 'name', 'display_name']);
        if ($this->assignPermissions) {
            $permissions = Permission::orderBy('name')
                ->get(['id', 'name', 'display_name']);
        }
        return view('admin.admins.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCrudRequest $request)
    {
        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $admin->attachRoles($request->roles ?? ['admin']);
        if ($this->assignPermissions) {
            $admin->attachPermissions($request->permissions ?? []);
        }

        return redirect(route('admin.admin.index'))->withSuccess("Admin {$admin->name} Addedd Succfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        return view('admin.admins.show' , $admin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('admin.admins.edit' , $admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AdminCrudRequest $request, User $admin)
    {
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $admin->syncRoles($request->roles ?? ['admin']);
        if ($this->assignPermissions) {
            $admin->syncPermissions($request->permissions ?? []);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        //
    }
}
