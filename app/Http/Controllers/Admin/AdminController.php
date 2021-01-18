<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminCrudRequest;
use App\Models\Permission;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Laratrust\Helper;
use Yajra\DataTables\DataTables;

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
            $admins = User::whereRoleIs(['admin', 'super_admin'])->with(['roles', 'permissions'])->latest();
            return DataTables::of($admins)
                ->addIndexColumn()
                ->addColumn('action', function ($admin) {
                    $btn = auth()->user()->isAbleTo('admins-update') ? '<a href="' . route('admin.admin.edit', $admin) . '" class="edit btn btn-primary btn-sm">Edit</a>' : "";
                    $btn .= auth()->user()->isAbleTo('admins-delete') ?
                        '<form action=" ' . route("admin.admin.destroy", $admin) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        ' . method_field('delete') . '
                        <button type="submit" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                            Delete Admin
                        </button>
                    </form>
                    ' : "";
                    return $btn;
                })
                ->addColumn('roles', function ($user) {
                    return $user->roles->pluck('display_name');
                })
                ->addColumn('permissions', function ($user) {
                    return $user->permissions->pluck('display_name');
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->diffForHumans();
                })
                ->rawColumns(['action', 'roles', 'permissions'])
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
        $roles = Role::orderBy('name')->where("name", 'like', '%admin%')->get(['id', 'name', 'display_name']);
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
        return view('admin.admins.show', $admin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {;

        $admin = $admin->load(['roles:id,name', 'permissions:id,name']);

        $roles = Role::orderBy('name')->where("name", 'like', '%admin%')->get(['id', 'name', 'display_name'])
            ->map(function ($role) use ($admin) {
                $role->assigned = $admin->roles
                    ->pluck('id')
                    ->contains($role->id);
                $role->isRemovable = Helper::roleIsRemovable($role);
                return $role;
            });

        if ($this->assignPermissions) {
            $permissions = Permission::orderBy('name')
                ->get(['id', 'name', 'display_name'])
                ->map(function ($permission) use ($admin) {
                    $permission->assigned = $admin->permissions
                        ->pluck('id')
                        ->contains($permission->id);
                    return $permission;
                });
        }

        return view('admin.admins.edit', [
            'admin' => $admin,
            'roles' => $roles,
            'permissions' => $this->assignPermissions ? $permissions : null,
        ]);
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
        $password = !is_null($request->password) ? ["password" => Hash::make($request->password)] : [];
        $admin->update($request->only(['email', 'name']) + $password);
        $admin->syncRoles($request->roles ?? ['admin']);
        if ($this->assignPermissions) {
            $admin->syncPermissions($request->permissions ?? []);
        }
        return back()->withSuccess("Admin {$admin->name} Updated Succfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        if ($admin->hasRole('super_admin') && User::whereRoleIs(['super_admin'])->count() <= 1) {
            return back()->withFailed("You can't delete the last super admin");
        }
        $admin->delete();
        return redirect(route('admin.admin.index'))->withSuccess("Admin {$admin->name} Deleted Succfully");
    }
}
