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
