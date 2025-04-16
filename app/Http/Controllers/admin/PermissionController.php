<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    protected $guard;

    public function __construct()
    {

        $this->middleware('permission:view permission', ['only' => ['index']]);
        $this->middleware('permission:create permission', ['only' => ['create','store']]);
        $this->middleware('permission:update permission', ['only' => ['update','edit']]);
        $this->middleware('permission:delete permission', ['only' => ['delete']]);

        $this->guard = "admin";
    }

    public function index()
    {
        $permissions = DB::select('CALL viewAll_permission()'); 
        //dd($permissions);
        return view('admin.RolePermission.Permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.RolePermission.Permission.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        $Permission = json_encode([
            'NamaPermission' => $request->name,
            'NamaGuard'  => $this->guard
        ]);

        $response = DB::statement('CALL insert_permission(:dataPermission)', ['dataPermission' => $Permission]);

        if ($response) {
            return redirect()->route('Permission.index')->with('success', 'Permission Berhasil Disimpan!');
        } else {
            return redirect()->route('Permission.create')->with('error', 'Permission Gagal Disimpan!');
        }
    }

    public function edit($id)
    {
        $PermissionData = DB::select('CALL view_permission_byId(' . $id . ')');
        $Permission = $PermissionData[0];

        if ($Permission) {
           return view('admin.RolePermission.Permission.edit', compact('Permission'));
        } else {
            return redirect()->route('Permission.index')->with('error', 'Permission Tidak Ditemukan!');
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$id
            ]
        ]);

        $Permission = json_encode([
            'IdPermission' => $id,
            'NamaPermission' => $request->name,
            'NamaGuard'  => $this->guard
        ]);

        //dd($BidangPekerjaan);

        $response = DB::statement('CALL update_permission(:dataPermission)', ['dataPermission' => $Permission]);

        if ($response) {
            return redirect()->route('Permission.index')->with('success', 'Permission Berhasil Diupdate!');
        } else {
            return redirect()->route('Permission.edit')->with('error', 'Permission Gagal Diupdate!');
        }
    }

    public function delete(Request $request)
    {
        $PermissionData = DB::select('CALL view_permission_byId(' . $request -> get('idPermission') . ')');
        $Permission = $PermissionData[0];

        if ($Permission) {
            $id = $request -> get('idPermission');

            $response = DB::select('CALL delete_permission(?)', [$id]);
            
            return response()->json([
                'status' => 200,
                'message'=> 'Data Permission Berhasil Dihapus.'
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Permission Tidak Ditemukan.'
            ]);
        }
    }
}
