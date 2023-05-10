<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

use Illuminate\Support\Carbon;

class ApiCategoryController extends Controller
{
    public function index() {
        $data = Category::select('category_name', 'category_image', 'category_icon', 'id')->get();
        $categoryDetailsArray = [];

        foreach($data as $value) {
            $subcategory = SubCategory::where('category_id', $value->id)->select('id','subcategory_name','category_id')->get();
           
            $subitem = [
                'category_name' => $value->category_name,
                'category_image' =>$value->category_image,
                'category_icon' =>$value->category_icon,
                'subcat' => $subcategory
               
            ];
            array_push($categoryDetailsArray, $subitem);
        }
        return $categoryDetailsArray;
    }
}
