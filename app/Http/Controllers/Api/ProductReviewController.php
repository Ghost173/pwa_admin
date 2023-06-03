<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;

class ProductReviewController extends Controller
{
    public function getAllReviewList(Request $request) {
        $product_id = $request->id;
        $result = ProductReview::where('product_id', $product_id)->where('status',1)->orderBy('id','desc')->get();
        return $result;
    }
}
