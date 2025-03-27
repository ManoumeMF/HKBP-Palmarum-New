<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    protected $guard;
    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index']]);
        $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update role', ['only' => ['update','edit']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);

        $this->guard = "admin";
    }

    public function index()
    {
        $roles = Role::get();
        return view('admin.RolePermission.Role.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('admin.RolePermission.Role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        $Role = json_encode([
            'NamaRole' => $request->name,
            'NamaGuard'  => $this->guard
        ]);

        //dd($BidangPekerjaan);

        $response = DB::statement('CALL insert_Role(:dataRole)', ['dataRole' => $Role]);

        if ($response) {
            return redirect()->route('Role.index')->with('success', 'Role Berhasil Disimpan!');
        } else {
            return redirect()->route('Role.create')->with('error', 'Role Gagal Disimpan!');
        }
    }

    public function edit($id)
    {
        $RoleData = DB::select('CALL view_role_byId(' . $id . ')');
        $Role = $RoleData[0];

        if ($RoleData) {
           return view('admin.RolePermission.Role.edit', compact('Role'));
        } else {
            return redirect()->route('Role.index')->with('error', 'Role Tidak Ditemukan!');
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$id
            ]
        ]);

        /*$role->update([
            'name' => $request->name
        ]);*/

        return redirect('roles')->with('status','Role Updated Successfully');
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status','Role Deleted Successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();

        return view('admin.RolePermission.Role.addPermission', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status','Permissions added to role');
    }
}
