<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Storage;


class AdminCategoryController extends Controller
{

    public function getallcategories () {
        $allcategories = Category::orderBy('id','desc')->paginate(10);
        $geturl =request()->getHttpHost();

        return view('admin.category.index',compact('allcategories'));
    }


    public function addcategory () {
        return view('admin.category.add');
    }

    public function storecategory (Request $request) {
        // $validated = $request->validate( [
        //     'category_name' => 'required|string|max:255',
        //     'category_image	' => 'required',
        //     'category_icon' => 'required|string',
        // ],
        // [
        //     'category_name.required' => 'category name cant be empty',
        //     'category_image.required' => 'We need category image to show in frontend ',
        //     'category_icon.required' => 'category icons are used in mega menu',
        // ]);
        // $admin = Auth::user();

        $category_name = $request->category_name;
        $category_image = $request->file('category_image');
        $category_icon = $request->file('category_icon');

        $category_image = $request->file('category_image');
        $name_gen_category = hexdec(uniqid()) . '.' . $category_image->getClientOriginalExtension();
        $image = Image::make($category_image)->resize(800, 460);
        $tempPath_category = 'upload/tests3/' . $name_gen_category ;
        $image->save($tempPath_category);
        $s3Path_category = 'upload/categories/category_image/';
        $urlpath_category =  'upload/categories/category_image/' . $name_gen_category;

        Storage::disk('s3')->putFileAs($s3Path_category, $tempPath_category,$name_gen_category);
        unlink($tempPath_category);
        $publicUrl = Storage::cloud('s3')->url($urlpath_category);
        return $publicUrl;


    }






    

    public function editcategory($id) {
        try {
            $category = Category::findOrFail($id);
            // Record found, handle it here
            return view('admin.category.edit',compact('category'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Record not found, handle the exception here
            
        }
        

    }

}
