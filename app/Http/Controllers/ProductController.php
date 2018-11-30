<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index(){
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_title','brands.brand_name')
            ->get();
        return view('dashboard.product.viewProduct',compact('products'));
    }

    public function addProduct(){
        $categories = Category::all();
        $brands = Brand::all();
        return view('dashboard.product.addProduct',compact('categories','brands'));
    }

    public function storeProduct(Request $request)
    {
        $this->validate($request,[
            'product_name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'product_price' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->product_name);

        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!file_exists('uploads/product')){
                mkdir('uploads/product',007,true);
            }else{
                $image->move('uploads/product',$imagename);
            }

        }else{
            $imagename = 'default.png';
        }

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->product_short_description = $request->short_description;
        $product->product_long_description = $request->long_description;
        $product->product_color = $request->product_color;
        $product->product_size = $request->product_size;
        $product->product_price = $request->product_price;
        $product->product_status = $request->status;
        $product->product_image = $imagename;
        $product->save();

        return Redirect::to('/viewProduct')->with('successMsg','Product Successfully Added');

    }

    public function updateProduct(Request $request,$id)
    {
        $this->validate($request,[
            'product_name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'product_price' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->product_name);

        $product = Product::find($id);

        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!file_exists('uploads/product')){
                mkdir('uploads/product',007,true);
            }else{
                $image->move('uploads/product',$imagename);
            }

        }else{
            $imagename = $product->product_image;
        }

        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->product_short_description = $request->short_description;
        $product->product_long_description = $request->long_description;
        $product->product_color = $request->product_color;
        $product->product_size = $request->product_size;
        $product->product_price = $request->product_price;
        $product->product_image = $imagename;
        $product->save();

        return Redirect::to('/viewProduct')->with('successMsg','Product Successfully Updated!!');

    }

    public function editProduct($id){
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('dashboard.product.editProduct',compact('product','categories','brands'));
    }

    public function inactiveProduct($id){
        $product = Product::find($id);
        $product->product_status = 0;
        $product->save();
        return Redirect::to('/viewProduct')->with('successMsg','Status Has Changed Successfully!!');
    }

    public function activeProduct($id){
        $product = Product::find($id);
        $product->product_status = 1;
        $product->save();
        return Redirect::to('/viewProduct')->with('successMsg','Status Has Changed Successfully!!');
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        if (file_exists('uploads/product/'.$product->product_image)){
            unlink('uploads/product/'.$product->product_image);
        }
        $product->delete();
        return redirect()->back()->with('successMsg','Dish Image Deleted Successfully!!');
    }

}
