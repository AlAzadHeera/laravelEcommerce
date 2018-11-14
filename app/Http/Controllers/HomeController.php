<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\subCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::all()->where('status','1');
        $brands = Brand::all()->where('brand_status','1');
        return view('pages.home',compact('categories','brands'));
    }
}
