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
}
