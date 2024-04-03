<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user(){

        $data['getRecord']=User::getRecordUser();

        return view('backend.user.list',$data);
    }
    public function add_user(Request $request){

        return view('backend.user.add');
    }

    public function insert_user(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
        ]);
        $user=new User;
        $user->name=trim($request->name);
        $user->email=trim($request->email);
        $user->password=Hash::make($request->password);
        $user->status=trim($request->status);
        $user->save();

        return redirect('panel/user/list')->with('success','User Successfully Created');
    }
    public function edit_user($id){

        $data['getRecord']=User::getSingle($id);

        return view('backend.user.edit',$data);
    }

    public function update_user(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required',
        ]);
        $user=User::getSingle($id);
        $user->name=trim($request->name);
        $user->email=trim($request->email);
        if(!empty($request->password)){
            $user->password=Hash::make($request->password);
        }
        $user->status=trim($request->status);
        $user->save();

        return redirect('panel/user/list')->with('success','User Successfully Updated');
    }

    public function delete_user($id){
        $user=User::getSingle($id);
        $user->is_delete=1;
        $user->save();

        return redirect()->back()->with('success','User Deleted');
    }
}
