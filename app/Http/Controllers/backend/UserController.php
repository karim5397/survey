<?php

namespace App\Http\Controllers\backend;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\user\StoreUserRequest;
use App\Http\Requests\user\UpdateUserRequest;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list', ['only' => ['index']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update','status']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy','groupDelete']]);
    }
    public function index()
    {
        $users=User::orderBy('id','DESC')->paginate(10);
        $roles=Role::get();
        return view('backend.pages.users.index',compact('users','roles'));
    }
    public function store(StoreUserRequest $request)
    {
        try {
            $data=$request->validated();
            $data['password']=Hash::make($request->password);
            $data['added_by']=auth()->user()->id;

            $user=User::create($data);
        
            $user->assignRole($request->roles);
            return redirect()->route('admin.user.index')->with('success','The user created successfully');

        } catch (Exception $ex) {
            return back()->with('error','something went wrong' . $ex->getMessage())->withInput();
        }
    }

  
    public function edit( User $user)
    {
        $user=User::findOrFail($user->id);
        $roles=Role::get();
        return view('backend.pages.users.edit',compact('user','roles'));
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        try{
            $user->findOrFail($user->id);
            $user->roles()->detach();//meaning delete role
            $user->assignRole($request->roles);
            $data=$request->validated();
            if(!empty($request->new_password) && $request->new_password != null){
                $data['password']=Hash::make($request->new_password);
            }
            $data['updated_by']=auth()->user()->id;
            $user->update($data);
            return redirect()->route('admin.user.index')->with('success','The user updated successfully');

        } catch (Exception $ex) {
            return back()->with('error','something went wrong' . $ex->getMessage())->withInput();
        }
        
    }

    public function destroy(User $user)
    {
        try{
            $user->findOrFail($user->id)->delete();
            return redirect()->route('admin.user.index')->with('success' ,'The user is deleted');

        }catch (Exception $ex) {
            return back()->with('error','something went wrong' . $ex->getMessage())->withInput();
        }
    }
    
    public function status(Request $request)
    {
        if($request->mode=='true')
        {
             DB::table('users')->where('id' , $request->id)->update(['status' => 'active']);
        }else{
             DB::table('users')->where('id' , $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg'=>'Status Successfully Updated' , 'status' => true]);
    }
}
