<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(){

        $data['getRecord']=User::getRecordUser();

        return view('backend.user.list',$data);
    }
}
