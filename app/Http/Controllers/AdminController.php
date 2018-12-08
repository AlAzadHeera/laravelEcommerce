<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();

class AdminController extends Controller
{
    public function index(){
       return view('login');
    }


    public function dashboardlog(Request $request){
        $email    = $request->email;
        $password = md5($request->password);
        $result = DB::table('admin')
            ->where('ademail',$email)
            ->where('adpassword',$password)
            ->first();

        if ($result){
            Session::put('adname',$result->adname);
            Session::put('adid',$result->adid);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Invalid email or password');
            return Redirect::to('/login');
        }
    }

    public function dashboardlogout(){

    }
}
