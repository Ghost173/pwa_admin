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
        $validated = $request->validate( [
            'category_name' => 'required',
            'category_image' => 'required',
            'category_icon' => 'required'
        ],
        [
            'category_name.required' => 'category name cant be empty',
            'category_image.required' => 'We need category image to show in frontend',
            'category_icon.required' => 'category icons are used in mega menu'
        ]);

   
        $admin = Auth::user();

        $category_name = $request->category_name;
        $category_image = $request->file('category_image');
        $category_icon = $request->file('category_icon');


        $name_gen_category = hexdec(uniqid()) . '.' . $category_image->getClientOriginalExtension();
        $image = Image::make($category_image)->resize(229, 207);
        $tempPath_category = 'upload/tests3/' . $name_gen_category ;
        $image->save($tempPath_category);
        $s3Path_category = 'upload/categories/category_image/';
        $urlpath_category =  'upload/categories/category_image/' . $name_gen_category;
        Storage::disk('s3')->putFileAs($s3Path_category, $tempPath_category,$name_gen_category);
        unlink($tempPath_category);
        $publicUrl_category_image = Storage::cloud('s3')->url($urlpath_category);

        $name_gen_category_icon = hexdec(uniqid()) . '.' . $category_icon->getClientOriginalExtension();
        $image = Image::make($category_icon)->resize(20, 20);
        $tempPath_category_icon = 'upload/tests3/' . $name_gen_category_icon ;
        $image->save($tempPath_category_icon);
        $s3Path_category_icon = 'upload/categories/category_icon/';
        $urlpath_category_icon =  'upload/categories/category_icon/' . $name_gen_category_icon;
        Storage::disk('s3')->putFileAs($s3Path_category_icon, $tempPath_category_icon,$name_gen_category_icon);
        unlink($tempPath_category_icon);
        $publicUrl_category_icon = Storage::cloud('s3')->url($urlpath_category_icon);

        $result = Category::insert([
            'category_name' => $category_name,
            'category_image' => $publicUrl_category_image,
            'category_icon' => $publicUrl_category_icon,
            'category_image_s3_location' => $urlpath_category,
            'category_icon_s3_location'  => $urlpath_category_icon,
            'created_user' => $admin->id,
            'created_at' =>Carbon::now()
        ]);

        $notification = array(
            'message' => 'Category was successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getcategories')->with($notification);

    }


     //delete category 
     public function deletecategory($id) {
        $category = Category::findorFail($id);

        //delete category images from S3
        if($category->category_image_s3_location) {
            $deleteImage = Storage::disk('s3')->delete($category->category_image_s3_location);
        }
       //delete category Icon from S3
        if($category->	category_icon_s3_location) {
            $deleteImage = Storage::disk('s3')->delete($category->	category_icon_s3_location);
        }
        $resultdelete = Category::where('id',$id)->delete();
       
        $notification = array(
            'message' => 'Category was deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getcategories')->with($notification);
     }



     // Category edit 
     public function editcategory($id) {

      $category = Category::findOrFail($id);
      return view('admin.category.edit',compact('category'));

    }

    // update category name
    public function updatecategoryName(Request $request, $id) {
        $validated = $request->validate( [
            'category_name' => 'required',
        ],
        [
            'category_name.required' => 'category name cant be empty',
        ]);
        
        $category = Category::findOrFail($id);
        Category::where('id',$id)->update([
            'category_name' => $request->category_name,
        ]);

        $notification = array(
            'message' => 'Category name was update successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getcategories')->with($notification);

    }



    public function updatecategoryImage(Request $request, $id) {
        $validated = $request->validate( [
            'category_image' => 'required'
        ],
        [
            'category_image.required' => 'We need category image to show in frontend'
        ]);
        $category = Category::findOrFail($id);

        $category_image = $request->file('category_image');

        $name_gen_category = hexdec(uniqid()) . '.' . $category_image->getClientOriginalExtension();
        $image = Image::make($category_image)->resize(229, 207);
        $tempPath_category = 'upload/tests3/' . $name_gen_category ;
        $image->save($tempPath_category);
        $s3Path_category = 'upload/categories/category_image/';
        $urlpath_category =  'upload/categories/category_image/' . $name_gen_category;
        Storage::disk('s3')->putFileAs($s3Path_category, $tempPath_category,$name_gen_category);
        unlink($tempPath_category);
        $publicUrl_category_image = Storage::cloud('s3')->url($urlpath_category);

        $categorys3url = $category->category_image_s3_location;
        if($categorys3url) {
            $deleteImage = Storage::disk('s3')->delete($categorys3url);
        }

        Category::where('id',$id)->update([
            'category_image' => $publicUrl_category_image,
            'category_image_s3_location'  =>  $urlpath_category,
        ]);

        $notification = array(
            'message' => 'Category image was update successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getcategories')->with($notification);
    }

}
