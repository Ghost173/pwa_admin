<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\SubCategory;
use App\Models\Category;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Carbon;

class AdminSubCategoryController extends Controller
{
    // Get all Sub categories
    public function getallsubcategories() {
        $subcategorie = SubCategory::latest()->get();
        return view('admin.subcategory.index',compact('subcategorie'));
    }


    //add sub category page 
    public function addsubcategory() {
        $category = Category::get();
        return view('admin.subcategory.add',compact('category'));
    }

    //store sub category 
    public function storesubcategory(Request $request) {
        $validated = $request->validate( [
            'subcategory_name' => 'required',
            'category_id' => 'required',
        ],
        [
            'subcategory_name.required' => 'Sub category name cant be empty',
            'category_id.required' => 'Please select a category',
        ]);

        SubCategory::insert([[
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $request->category_id,
            'created_at' => Carbon::now()
        ]]);

        $notification = array(
            'message' => 'Sub Category was created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallsubcategories')->with($notification);
    }


    // delete subcategory 
    public function deletesubcategory($id) {
        $subcategory = SubCategory::findorFail($id);
        $resultdelete = SubCategory::where('id',$id)->delete();

        $notification = array(
            'message' => 'Sub Category was deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallsubcategories')->with($notification);
    }


    //edit subcategory page 
    public function editsubcategory($id) {
        $subcat = SubCategory::findorFail($id);
        $category = Category::get();
        return view('admin.subcategory.edit',compact('subcat', 'category'));
    }


    //update sub category 
    public function updatesubcategoryName(Request $request, $id) {
        $subcat = SubCategory::findorFail($id);

        $validated = $request->validate( [
            'subcategory_name' => 'required',
            'category_id' => 'required',
        ],
        [
            'subcategory_name.required' => 'Sub category name cant be empty',
            'category_id.required' => 'Please select a category',
        ]);

        SubCategory::where('id',$id)->update([
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $request->category_id,
        ]);

        $notification = array(
            'message' => 'Sub Category was update successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallsubcategories')->with($notification);

    }

}
