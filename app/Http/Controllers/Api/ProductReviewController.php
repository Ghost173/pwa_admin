<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Models\ProductCart;
use App\Models\ProductList;
use App\Models\productDetails;
use App\Models\Orders;
use Illuminate\Support\Carbon;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\Customercancelorder;
use App\Models\User;


class ProductReviewController extends Controller
{
    public function getAllReviewList(Request $request) {
        $product_id = $request->id;
        $result = ProductReview::where('product_id', $product_id)->where('status',1)->orderBy('id','desc')->get();
        return $result;
    }



    public function postreview (Request $request) {
        $validator = Validator::make($request->all(), [
            'reviewer_rating' => 'required|string|max:255',
            'order_id' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 401);
        }

        $orderid = $request->order_id;
        $reviewer_rating = $request->reviewer_rating;
        $reviewer_comments = $request->reviewer_comments;

        $user = Auth::user();


        $getorder = Orders::where('order_id',$orderid)->first();

        if($getorder) {
            $checkreview = ProductReview::where('order_id', $orderid)->first();
            
            if($checkreview ) {
                return response()->json(['error' => 'All ready you review this product '], 409);
            } else {
                $insertreview = ProductReview::insert([
                    'product_id' => $getorder->product_id,
                    'product_name' => $getorder->product_name,
                    'reviewer_name' => $getorder->customer_name,
                    'reviewer_rating' => $reviewer_rating,
                    'reviewer_comments' => $reviewer_comments,
                    'order_id' => $orderid,
                    'created_at' =>  Carbon::now(),
                ]);

                if($insertreview == 1) {
                    $orderupdate = Orders::where('order_id',$orderid)->update(['review' =>1]);
                }

                return response()->json(['success' => 'Your review has been successfully submitted'], 200);
            }


        } else {
            return response()->json(['error' => 'There are no orders found with in the database '], 409);
        }

    }



    //requestorder camcel 
    public function requestordercancel(Request $request) {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'customer_cancel_reason' => 'required|string|max:255',
            'order_id' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 401);
        }

        $orderid = $request->order_id;
        $customer_cancel_reason = $request->customer_cancel_reason;

        $getorder = Orders::where('order_id',$orderid)->first();
        $checkorderstatus = $getorder->customer_cancel_request;

        if($getorder) {
            if($checkorderstatus == 0) {
               $cancelorder = Orders::where('id',$getorder->id)->update([
                    'customer_cancel_reason' => $customer_cancel_reason,
                    'customer_cancel_request' => 1,     
                    'updated_at' => Carbon::now()         
                ]);


                $mailData = [
                    'name' => $getorder->customer_name,
                    'quantity' => $getorder->product_quantity,
                    'product_name' => $getorder->product_name,
                    'product_unit_price' => $getorder->product_unit_price,
                    'product_total_price' => $getorder->product_total_price,
                    'orderid' => $orderid,
             ];
             if($cancelorder == 1) {
                $getorderuser = User::where('id',$getorder->user_id)->first();
                $getorderuseremail =$getorderuser->email;

                try {
                    Mail::to($getorderuseremail)->send(new Customercancelorder($mailData));
                    
                    }catch(\Throwable $th) {

                    }
             }
               

                return response()->json(['success' => 'You cancel order request submit success'], 200);
            } else {
                return response()->json(['error' => 'You already request a cancel order'], 409); 
            }

        } else {
            return response()->json(['error' => 'There are no orders found with in the database '], 409); 
        }

    }
}
