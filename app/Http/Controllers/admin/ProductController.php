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
}
