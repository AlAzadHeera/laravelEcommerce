<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\Slider;
use App\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::all()->where('status','1');
        $brands = Brand::all()->where('brand_status','1');
        $sliders = Slider::all()->where('status','1');
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_title','brands.brand_name')
            ->where('products.product_status',1)
            ->limit(6)
            ->get();

        return view('pages.home',compact('categories','brands','products','sliders'));
    }
}
