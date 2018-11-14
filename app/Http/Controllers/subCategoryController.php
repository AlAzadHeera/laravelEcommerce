<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class subCategoryController extends Controller
{
    public function index(){
        $subCategories = DB::table('menus')
            ->join('categories', 'menus.category_id', '=', 'categories.id')
            ->select('menus.*', 'categories.category_title')
            ->get();
        return view('dashboard.subCategory.viewCategory',compact('subCategories'));
    }

    public function addSubCategory(){
        $categories = Category::all();
        return view('dashboard.subCategory.addSubCategory',compact('categories'));
    }

    public function storeSubCategories(Request $request){
        $data = array();
        $data['menu_title'] = $request->title;
        $data['menu_description'] = $request->description;
        $data['menu_status'] = $request->status;
        $data['category_id'] = $request->categoryId;

        DB::table('menus')->insert($data);
        return Redirect::to('/viewCategory')->with('successMsg','Category Added Successfully!!');
    }

    public function inactiveSubCategory($id){
        $subCategory = Menu::find($id);
        $subCategory->menu_status = 0;
        $subCategory->save();
        return Redirect::to('/viewCategory')->with('successMsg','Status Has Changed Successfully!!');
    }

    public function activeSubCategory($id){
        $subCategory = Menu::find($id);
        $subCategory->menu_status = 1;
        $subCategory->save();
        return Redirect::to('/viewCategory')->with('successMsg','Status Has Changed Successfully!!');
    }

    public function editSubCategory($id){
        $subCategories = Menu::find($id);
        $categories = Category::all();
        return view('dashboard.subCategory.editSubCategory',compact(['subCategories','categories']));
    }

    public function updateSubCategory(Request $request, $id){
        $subCategory = Menu::find($id);
        $subCategory['menu_title'] = $request->title;
        $subCategory['menu_description'] = $request->description;
        $subCategory['category_id'] = $request->categoryId;

        $subCategory->save();

        return Redirect::to('/viewCategory')->with('successMsg','Category Updated Successfully..!!');

    }

    public function deleteSubCategory($id) {
        $category = Menu::find($id);
        $category->delete();
        return Redirect::to('/viewCategory')->with('successMsg','Category Deleted Successfully..!!');
    }

}
