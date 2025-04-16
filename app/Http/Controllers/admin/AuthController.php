<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //Registration
    public function registration()
    {
        return view('admin.Auth.registration');
    }
    public function registerUser(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email:users',
            'password'=>'required|min:8|max:12'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $result = $user->save();
        if($result){
            return back()->with('success','You have registered successfully.');
        } else {
            return back()->with('fail','Something wrong!');
        }
    }
    ////Login
    public function login()
    {
        return view('admin.Auth.login');
    }
    public function loginUser(Request $request)
    {
        //dd($request->all());

        $credentials = $request->validate([            
            'email'=>'required|email:users',
            'password'=>'required|min:8|max:12'
        ]);

        /*$user = User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                
                //return redirect('dashboard');
                return view('admin.Dashboard.index');
            } else {
                return back()->with('fail','Password not match!');
            }
        } else {
            return back()->with('fail','This email is not register.');
        } */

        if(Auth::attempt($credentials))
        {
            //dd(Auth::check());
            $user = Auth::user();

            $userData = DB::select('CALL view_userSessionById(?, ?)', [$user->id, $user->idJenisUser]);
            //dd($userData[0]->results);
            $request->session()->put('userSession', $userData[0]->results);

            return redirect()->route('Dashboard.index')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
       
        
    }
    //// Dashboard
    public function dashboard()
    {
        // return "Welcome to your dashabord.";
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
        }
        return view('dashboard',compact('data'));
    }
    ///Logout
    public function logout()
    {
        Auth::logout(); // user must logout before redirect them
        session()->flush();
        return redirect()->route('login');

        /*$data = array();
        if(Session::has('loginId')){
            Session::pull('loginId');
            return view('admin.Auth.login');
        }*/
    }
}