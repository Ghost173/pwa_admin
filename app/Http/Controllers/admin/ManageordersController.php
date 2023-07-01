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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

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

    public function getallcancelorders () {
        $cancelorders = Orders::where('order_status' , 'Cancel')->orderBy('id', 'DESC')->get();
        return view('admin.orders.cancelorders' ,compact('cancelorders'));
    }

    public function oderdetailsbyid($id) {
        $getorders = Orders::where('id' , $id)->first();
        return view('admin.orders.orderdetails' ,compact('getorders'));
    }


    public function pendingtoprocessing($id) {
        $order = Orders::findorFail($id)->update([
            'order_status' => 'Processing',
            'updated_at' => Carbon::now(),   
        ]);

        $notification = array(
            'message' => 'Order move to Processing',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallpendongorders')->with($notification);
    }


    public function processingtoconfirm($id) {
        $order = Orders::findorFail($id)->update([
            'order_status' => 'Complete',
            'updated_at' => Carbon::now(),   
        ]);

        $notification = array(
            'message' => 'Order mark as Complete',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallprocessingoders')->with($notification);
    }


    public function confirmtocancel($id) {
        $order = Orders::findorFail($id)->update([
            'order_status' => 'Cancel',
            'updated_at' => Carbon::now(),   
        ]);

        $notification = array(
            'message' => 'Order mark as Cancel',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallpendongorders')->with($notification);
    }


    public function updatepaymentid(Request $request, $id) {
        $validated = $request->validate( [
            'payment_id' => 'required',
        ],
        [
            'payment_id.required' => 'Please enter payment id',

        ]);

        $order = Orders::findorFail($id)->update([
            'payment_id' => $request->payment_id
        ]);

        $notification = array(
            'message' => 'Payment id hasbeen updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
