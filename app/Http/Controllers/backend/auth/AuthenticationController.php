<?php

namespace App\Http\Controllers\backend\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function loginForm()
    {
        return view('backend.auth.login');
    }
    public function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|exists:users,email',
            'password'=>'required',
        ],[
            'email.required'=>'The email field is required',
            'email.exists'=>'The email does not exists',
            'password.required'=>'The password field is required',
        ]);

        if(Auth::attempt(['email'=>$request->email , 'password' =>$request->password])){
            return redirect()->route('admin.questionnaire.index')->with('success','Login successfully');
        }else{
            if(!Hash::check($request->password,User::where(['email'=>$request->email])->value('password'))){
                return back()->withErrors([
                    'password'=>'The password is wrong',
                ]);
            }

        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login.form');
    }
}
