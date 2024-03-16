<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\RegisterMail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function logout(){
        Auth::logout();
        return redirect('login');
    }
    public function register(){
        return view('auth.register');
    }
    public function forgot_pass(){
        return view('auth.forgot_pass');
    }
    public function forgot_password(Request $request){
       $user=User::where('email',$request->email)->first();
       if(!empty($user)){
            $user->remember_token=Str::random(40);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success','Please check your email and reset your password');


       }else{
        return redirect()->back()->with('error','Email Not Found');
       }
    }

    public function reset($token){
        $user=User::where('remember_token',$token)->first();
        if(!empty($user)){
            $data['user']=$user;
            return view('auth.reset',$data);

        }else{
         return redirect()->back()->with('error','Email Not Found');
        }
    }
    public function reset_pass($token,Request $request){
        $user=User::where('remember_token',$token)->first();
        if(!empty($user)){
            if($request->password == $request->cpassword){
                $user->password=Hash::make($request->password);

                if(!empty($user->email_verified_at)){
                    $user->email_verified_at=date('Y-m-d H:i:s');

                }

                $user->remember_token=Str::random(40);
                $user->save();

                return redirect('login')->with('success','Password has been updated successfully');


            }else{
                return redirect()->back()->with('error',"Password and Confirm Password doesn't match" );

            }
        }else{

        }

    }
    public function create_user(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ]);
       $user=new User;
       $user->name=trim($request->name);
       $user->email=trim($request->email);
       $user->password=Hash::make($request->password);
       $user->remember_token=Str::random(40);
       $user->save();

       Mail::to($user->email)->send(new RegisterMail($user));
       return redirect('login')->with('success','Account Registered Successfully,Please Verify Your Email Address' );


    }

    public function verify($token){
        $user=User::where('remember_token',$token)->first();
        if(!empty($user)){
           $user->email_verified_at=date('Y-m-d H:i:s');
           $user->remember_token=Str::random(40);

           $user->save();
           return redirect('login')->with('success','Account Verified Successfully' );


        }else{
            abort(404);
        }
    }

    public function auth_login(Request $request){
        $remember=!empty($request->remember) ? true : false;
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])){
            if(Auth::user()->email_verified_at){
                return redirect('panel/dashboard');

            }else{

                $user_id=Auth::user()->id;
                $user=User::getSingle($user_id);
                Auth::logout();

                $user->remember_token=Str::random(40);
                $user->save();


                Mail::to($user->email)->send(new RegisterMail($user));
                return redirect()->back()->with('success','Please Verify Your Email Address' );


            }

        }else{
            return redirect()->back()->with('error','Please Enter correct email and password');
        }
    }
}
