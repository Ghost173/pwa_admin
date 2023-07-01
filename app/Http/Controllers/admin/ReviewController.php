<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\ProductList;
use App\Models\ProductReview;
use Illuminate\Support\Carbon;


class ReviewController extends Controller
{
    

    // get all pending reviews 
    public function allpendingreviews() {
        $productpendingreviews = ProductReview::where('status', 0)->latest()->get();
        return  view('admin.reviews.pendingreviews',compact('productpendingreviews'));
    }

    // get all approved reviews 
    public function allapprovedreview() {
        $productapprovedreviews = ProductReview::where('status', 1)->latest()->get();
        return  view('admin.reviews.approvedreview',compact('productapprovedreviews'));
    }


    public function approvereview($id) {
        $order = ProductReview::findorFail($id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),   
        ]);

        $notification = array(
            'message' => 'Review is now active',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deactivereview($id) {
        $order = ProductReview::findorFail($id)->update([
            'status' => 0,
            'updated_at' => Carbon::now(),   
        ]);

        $notification = array(
            'message' => 'Review is mark asd pending',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
