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
        $subcategorie = SubCategory::get();
        return view('admin.subcategory.index',compact('subcategorie'));
    }


    //add sub category page 
    public function addsubcategory() {
        $category = Category::get();
        return view('admin.subcategory.add',compact('category'));
    }
}
