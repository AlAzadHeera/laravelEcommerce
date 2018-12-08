<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SuperAdminController extends Controller
{

    public function index(){
        $this->checkLogin();
        return view('dashboard.dashboard');
    }

    public function logout(){
        Session::flush();
        return Redirect::to('/login');
    }

    public function checkLogin(){
        $admin = Session::get('adid');
        if ($admin){
            return;
        }else{
            return Redirect::to('/login')->send();
        }
    }

}

