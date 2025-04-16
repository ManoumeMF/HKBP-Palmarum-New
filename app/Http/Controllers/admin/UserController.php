<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create','store']]);
        $this->middleware('permission:update user', ['only' => ['update','edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = DB::select('CALL viewAll_user()');
        $dataArray = json_decode($users[0]->results, true); // Convert only if it's a string
        
        return view('admin.RolePermission.User.index', compact('dataArray'));
    }

    public function create()
    {
        $userTypes = DB::select('CALL cbo_jenisUser()');
        $roles = DB::select('CALL cbo_role()');
        return view('admin.RolePermission.User.create', compact('roles', 'userTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $modelType = "App\Models\User";

        $userData = json_encode([
            'IdJenisUser' => $request->jenisUser,
            'IdPersonal'  => $request->idPersonal,
            'Username'  => $request->username,
            'Email'  => $request->email,
            'Password'  => Hash::make($request->password),
            'ModelType'  => $modelType,
            'Roles'  => $request->roles
        ]);

        //dd($userData);

        $response = DB::statement('CALL insert_user(:dataUser)', ['dataUser' => $userData]);

        if ($response) {
            return redirect()->route('User.index')->with('success', 'User Berhasil Disimpan!');
        } else {
            return redirect()->route('User.create')->with('error', 'User Gagal Disimpan!');
        }
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(!empty($request->password)){
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status','User Updated Successfully with roles');
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status','User Delete Successfully');
    }

    public function getNamaLengkap(Request $request)
    {
        $id = $request->idJenis;

        $fullNames = DB::select('CALL cbo_namaLengkapUser(' . $id . ')');

        return response()->json($fullNames);
    }
}
