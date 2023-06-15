<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\ProductList;
use App\Models\productDetails;
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
        $products  = ProductList::latest()->get();
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
}
