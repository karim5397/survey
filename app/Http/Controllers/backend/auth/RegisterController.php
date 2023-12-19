<?php

namespace App\Http\Controllers\backend\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('backend.auth.register');
    }
    public function register(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255|string',
            'email' => 'required|max:255|string|email|unique:users,email',
            'password' => 'required|regex:/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
           
        ],[
            'name.required' =>'The name field is required',
            'email.required' =>'The email field is required',
            'password.required' =>'The password field is required',
            'password.regex' =>'The password must contain <br>
                                1- Password must be more than 8 characters <br>
                                2- English uppercase characters (A – Z) <br>
                                3- English lowercase characters (a – z) <br>
                                4- Digits number (0 – 9) <br>
                                5- Non-alphanumeric (For example: !, $, #, @ or %) ',
        ]);
        $data=$request->all();
        $data['password']=Hash::make($request->password);
        $user=User::create($data);
        Auth::login($user);
        if($user){
            return redirect()->route('admin.questionnaire.index')->with('success','Register successfully');
        }else{
            return redirect()->back()->with('error','something went wrong');

        }
    }
}
