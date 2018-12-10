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
           'image'       => 'required | mimes:jpg,jpeg,png'
        ]);

        $image = $request->file('image');
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

        $slider = new Slider();
        $slider->heading1 = $request->heading_one;
        $slider->heading2 = $request->heading_two;
        $slider->description = $request->description;
        $slider->link = $request->url;
        $slider->image = $imagename;
        $slider->status = $request->status;
        $slider->save();

        return Redirect::to('/index')->with('successMsg','Slider Successfully Added!!');

    }

    public function updateSlider(Request $request, $id){
        $this->validate($request,[
            'heading_one' => 'required',
            'heading_two' => 'required',
            'description' => 'required',
            'url'         => 'required',
            'image'       => 'mimes:jpg,jpeg,png'
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

        $slider->heading1 = $request->heading_one;
        $slider->heading2 = $request->heading_two;
        $slider->description = $request->description;
        $slider->link = $request->url;
        $slider->image = $imagename;
        $slider->save();

        return Redirect::to('/sliders')->with('successMsg','Slider Successfully Updated!!');

    }

    public function deleteSlider($id){
        $slider = Slider::find($id);
        if (file_exists('uploads/slider/'.$slider->image)){
            unlink('uploads/slider/'.$slider->image);
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


