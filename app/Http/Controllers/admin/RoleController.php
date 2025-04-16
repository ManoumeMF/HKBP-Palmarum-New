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
        $this->middleware('permission:delete role', ['only' => ['delete']]);

        $this->guard = "admin";
    }

    public function index()
    {
        //$roles = Role::get();
        $roles = DB::select('CALL viewAll_role()'); 
        return view('admin.RolePermission.Role.index', compact('roles'));
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

        if ($Role) {
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

        $Role = json_encode([
            'IdRole' => $id,
            'NamaRole' => $request->name,
            'NamaGuard'  => $this->guard
        ]);

        //dd($BidangPekerjaan);

        $response = DB::statement('CALL update_role(:dataRole)', ['dataRole' => $Role]);

        if ($response) {
            return redirect()->route('Role.index')->with('success', 'Role Berhasil Diupdate!');
        } else {
            return redirect()->route('Role.edit')->with('error', 'Role Gagal Diupdate!');
        }

    }

    public function delete(Request $request)
    {
        $roleData = DB::select('CALL view_role_byId(' . $request -> get('idRole') . ')');
        $Role = $roleData[0];

        if ($Role) {
            $id = $request -> get('idRole');

            $response = DB::select('CALL delete_role(?)', [$id]);
            
            return response()->json([
                'status' => 200,
                'message'=> 'Data Role Berhasil Dihapus.'
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Role Tidak Ditemukan.'
            ]);
        }
    }

    public function addPermissionToRole()
    {
        //$roleId = 1;
        $permissions = Permission::get();
        $role = Role::get();
        //dd($role);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', 1)
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
