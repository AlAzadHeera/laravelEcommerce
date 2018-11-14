<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function allCategories(){
        $categories = Category::all();
        return view('dashboard.category.categories',compact('categories'));
    }

    public function index(){
        return view('dashboard.category.addCategory');
    }

    public function storeCategories(Request $request){
        $data = array();
        $data['category_title'] = $request->title;
        $data['category_description'] = $request->description;
        $data['status'] = $request->status;


        DB::table('categories')->insert($data);
        return Redirect::to('/allCategory')->with('successMsg','Category Added Successfully!!');
    }

    public function inactiveCategory($id){
        $category = Category::find($id);
        $category->status = 0;
        $category->save();
        return Redirect::to('/allCategory')->with('successMsg','Status Has Changed Successfully!!');
    }

    public function activeCategory($id){
        $category = Category::find($id);
        $category->status = 1;
        $category->save();
        return Redirect::to('/allCategory')->with('successMsg','Status Has Changed Successfully!!');
    }

    public function editCategory($id){
        $categories = Category::find($id);
       return view('dashboard.category.editCategory',compact('categories'));
    }

    public function updateCategory(Request $request, $id){
        $category = Category::find($id);
        $category['category_title'] = $request->title;
        $category['category_description'] = $request->description;

        $category->save();

        return Redirect::to('/allCategory')->with('successMsg','Category Updated Successfully..!!');

    }

    public function deleteCategory($id) {
        $category = Category::find($id);
        $category->delete();
        return Redirect::to('/allCategory')->with('successMsg','Category Deleted Successfully..!!');
    }

}
