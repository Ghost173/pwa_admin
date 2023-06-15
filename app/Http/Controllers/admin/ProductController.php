<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\ProductList;
use App\Models\productDetails;
use App\Models\Category;
use App\Models\SubCategory;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Carbon;
use Storage;


class ProductController extends Controller
{
    
    // get all products and return to view 
    public function getallproducts() {
        $products  = ProductList::latest()->paginate(10);
        return  view('admin.products.index',compact('products'));
    }

    public function activateproduct($id) {
        $product = ProductList::findorFail($id)->update([
            'product_status' => 1,
            'updated_at' => Carbon::now(),   
        ]);

        $notification = array(
            'message' => '	product status was mark as active',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallproducts')->with($notification);
    }

// Deactivate a product
    public function deactivateproduct($id) {
        $product = ProductList::findorFail($id)->update([
            'product_status' => 0,
            'updated_at' => Carbon::now(),   
        ]);

        $notification = array(
            'message' => '	product status was mark as deactivateproduct',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallproducts')->with($notification);
    }


    // add products 
    public function addproduct() {
    $category = Category::orderBy('category_name','ASC')->get();
    $subcategory = SubCategory::orderBy('subcategory_name','ASC')->get();

        return view ('admin.products.addproduct', compact('category', 'subcategory'));
    }

    public function categorysub($product_category_id) {
        $subcat = SubCategory::where('category_id', $product_category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);
    }
}
