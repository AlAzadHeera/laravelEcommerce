<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('dashboard.brand.brands',compact('brands'));
    }

    public function addBrand(){
        return view('dashboard.brand.addBrand');
    }

    public function storeBrand(Request $request){
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_description'] = $request->description;
        $data['brand_status'] = $request->brand_status;

        DB::table('brands')->insert($data);
        return Redirect::to('/viewBrand')->with('successMsg','Brand Added Successfully!!');
    }

    public function inactiveBrand($id){
        $brand = Brand::find($id);
        $brand->brand_status = 0;
        $brand->save();
        return Redirect::to('/viewBrand')->with('successMsg','Status Has Changed Successfully!!');
    }

    public function activeBrand($id){
        $brand = Brand::find($id);
        $brand->brand_status = 1;
        $brand->save();
        return Redirect::to('/viewBrand')->with('successMsg','Status Has Changed Successfully!!');
    }

    public function editBrand($id){
        $brands = Brand::find($id);
        return view('dashboard.brand.editBrand',compact('brands'));
    }

    public function updateBrand(Request $request, $id){
        $brand = Brand::find($id);
        $brand['brand_name'] = $request->brand_name;
        $brand['brand_description'] = $request->brand_description;

        $brand->save();

        return Redirect::to('/viewBrand')->with('successMsg','Brand Updated Successfully..!!');

    }

    public function deleteBrand($id) {
        $brand = Brand::find($id);
        $brand->delete();
        return Redirect::to('/viewBrand')->with('successMsg','Brand Deleted Successfully..!!');
    }
}
