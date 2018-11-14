<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SuperAdminController extends Controller
{
    public function logout(){
        //Session::put('adname',null);
        //Session::put('adid',null);
        Session::flush();
        return Redirect::to('/login');
    }
}
