<?php

namespace App\Http\Controllers;

use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        return view('dashboard.slider.index',compact('sliders'));
    }

    public function create(){
        return view('dashboard.slider.create');
    }

    public function editSlider($id){
        $slider = Slider::find($id);
        return view('dashboard.slider.edit',compact('slider'));
    }

    public function storeSlider(Request $request){

        $this->validate($request,[
           'heading_one' => 'required',
           'heading_two' => 'required',
           'description' => 'required',
           'url'         => 'required',
           'image'       => 'required | mimes:jpg,jpeg,png',
            'price_image'       => 'required | mimes:jpg,jpeg,png',
        ]);

        /*return $request->all();*/

        $image = $request->file('image');
        $priceImage = $request->file('price_image');
        $slug = str_slug($request->heading_one);

        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!file_exists('uploads/slider')){
                mkdir('uploads/slider',007,true);
            }else{
                $image->move('uploads/slider',$imagename);
            }

        }else{
            $imagename = 'default.png';
        }

        if (isset($priceImage)){
            $currentDate = Carbon::now()->toDateString();
            $priceImageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$priceImage->getClientOriginalExtension();

            if (!file_exists('uploads/slider')){
                mkdir('uploads/slider',007,true);
            }else{
                $priceImage->move('uploads/slider',$priceImageName);
            }

        }else{
            $priceImageName = 'default.png';
        }

        $slider = new Slider();
        $slider->heading1 = $request->heading_one;
        $slider->heading2 = $request->heading_two;
        $slider->description = $request->description;
        $slider->link = $request->url;
        $slider->image = $imagename;
        $slider->price_image = $priceImageName;
        $slider->status = $request->status;
        $slider->save();

        return Redirect::to('/sliders')->with('successMsg','Slider Successfully Added!!');

    }

    public function updateSlider(Request $request, $id){
        $this->validate($request,[
            'heading_one' => 'required',
            'heading_two' => 'required',
            'description' => 'required',
            'url'         => 'required',
            'image'       => 'mimes:jpg,jpeg,png',
            'price_image' => 'mimes:jpg,jpeg,png'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->heading_one);
        $slider = Slider::find($id);

        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!file_exists('uploads/slider')){
                mkdir('uploads/slider',007,true);
            }else{
                $image->move('uploads/slider',$imagename);
            }

        }else{
            $imagename = $slider->image;
        }

        $price_image = $request->file('price_image');
        $slug = str_slug($request->heading_one);
        $slider = Slider::find($id);

        if (isset($price_image)){
            $currentDate = Carbon::now()->toDateString();
            $price_image_name = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!file_exists('uploads/slider')){
                mkdir('uploads/slider',007,true);
            }else{
                $price_image->move('uploads/slider',$price_image_name);
            }

        }else{
            $price_image_name = $slider->price_image;
        }

        $slider->heading1 = $request->heading_one;
        $slider->heading2 = $request->heading_two;
        $slider->description = $request->description;
        $slider->link = $request->url;
        $slider->image = $imagename;
        $slider->price_image = $price_image_name;
        $slider->save();

        return Redirect::to('/sliders')->with('successMsg','Slider Successfully Updated!!');

    }

    public function deleteSlider($id){
        $slider = Slider::find($id);
        if (file_exists('uploads/slider/'.$slider->image)){
            unlink('uploads/slider/'.$slider->image);
        }
        if (file_exists('uploads/slider/'.$slider->price_image)){
            unlink('uploads/slider/'.$slider->price_image);
        }
        $slider->delete();
        return redirect()->back()->with('successMsg','Slider Deleted Successfully!!');
    }

    public function inactiveSlider($id){
        $slider = Slider::find($id);
        $slider->status = 0;
        $slider->save();
        return Redirect::to('/sliders')->with('successMsg','Status Has Changed Successfully!!');
    }

    public function activeSlider($id){
        $slider = Slider::find($id);
        $slider->status = 1;
        $slider->save();
        return Redirect::to('/sliders')->with('successMsg','Status Has Changed Successfully!!');
    }

}


