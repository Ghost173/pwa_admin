<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\ProductList;
use App\Models\productDetails;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Orders;
use App\Models\ProductReview;
use App\Models\ProductCart;
use Auth;
use DB;

class ManageordersController extends Controller
{


    public function getpendingorders () {
        $pendingorders = Orders::where('order_status' , 'Pending')->orderBy('id', 'DESC')->get();
        return view('admin.orders.pendingorder' ,compact('pendingorders'));
    }

    public function getallprocessingoders () {
        $Processingorders = Orders::where('order_status' , 'Processing')->orderBy('id', 'DESC')->get();
        return view('admin.orders.processingorder' ,compact('Processingorders'));
    }

    public function getallcompleteorders () {
        $completeorders = Orders::where('order_status' , 'Complete')->orderBy('id', 'DESC')->get();
        return view('admin.orders.completeorder' ,compact('completeorders'));
    }

    public function oderdetailsbyid($id) {
        $getorders = Orders::where('id' , $id)->first();
        return view('admin.orders.orderdetails' ,compact('getorders'));
    }
}
