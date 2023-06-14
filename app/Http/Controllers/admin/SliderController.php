<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Slider;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Carbon;
use Storage;


class SliderController extends Controller
{
    // home page slider 
    public function getallsliders() {
        $sliders =Slider::get();
        return view('admin.sliders.index', compact('sliders'));
    }

    // add slider view 
    public function addslider() {
        return view('admin.sliders.add');
    }

    // save slider
    public function storeslider(Request $request) {
        $validated = $request->validate( [
            'slider_image' => 'required',
        ],
        [
            'slider_image.required' => 'Please upload slider image',
        ]);

        $admin = Auth::user();
        $slider_image = $request->file('slider_image');
        $name_gen_slider = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        $image = Image::make($slider_image)->resize(1024,379);
        $tempPath_sliderPath = 'upload/tests3/' . $name_gen_slider ;
        $image->save($tempPath_sliderPath);

        $s3Path_slider = 'sliders/';
        $urlpath_slider =  'sliders/' . $name_gen_slider;
        Storage::disk('s3')->putFileAs($s3Path_slider, $tempPath_sliderPath,$name_gen_slider);
        unlink($tempPath_sliderPath);
        $publicUrl_slider_image = Storage::cloud('s3')->url($urlpath_slider);

        Slider::insert([
            'slider_image' => $publicUrl_slider_image,
            'slider_s3_location' => $urlpath_slider,
            'created_by' => $admin->id,
            'created_at' =>Carbon::now()
        ]);


        $notification = array(
            'message' => 'slider was created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallsliders')->with($notification);
    }


    public function deleteslider($id) {
        $slider = Slider::findorFail($id);

        // delete image from s3
        $deleteImage = Storage::disk('s3')->delete($slider->slider_s3_location);

        // delete slider record from database
        Slider::where('id',$id)->delete();

        $notification = array(
            'message' => 'slider was deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallsliders')->with($notification);

    }

    public function activeslider($id) {
        $slider = Slider::findorFail($id)->update([
            'slider_status' => 1,
            'updated_at' => Carbon::now(),   
        ]);

        $notification = array(
            'message' => 'slider was activated',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallsliders')->with($notification);
    }

    public function deactiveslider($id) {
        $slider = Slider::findorFail($id)->update([
            'slider_status' => 0,
            'updated_at' => Carbon::now(),   
        ]);

        $notification = array(
            'message' => 'slider was deactivated',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallsliders')->with($notification);
    }
}
