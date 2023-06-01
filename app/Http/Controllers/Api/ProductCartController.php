<?php

namespace App\Http\Controllers\Api;
use App\Models\ProductCart;
use App\Models\ProductList;
use App\Models\productDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class ProductCartController extends Controller
{
    public function addtocart(Request $request) {
        $email = $request->input('email');
        $product_size = $request->input('product_size');
        $product_color = $request->input('product_color');
        $product_quantity = $request->input('product_quantity');
        $product_id = $request->input('product_id');
        $user_id = $request->input('user_id');
        $product_details = ProductList::where('id', $product_id)->get();
        $price = $product_details[0]['product_price'];
        $discount_price = $product_details[0]['discount_price'];
        $product_image = $product_details[0]['product_image'];
        $product_title =  $product_details[0]['product_title'];


        $validatecart = ProductCart::where('user_id',$user_id)->where('product_id',$product_id)->get();
        $count = $validatecart->count();

         if($count > 0) {
            return response()->json(['error' => 'Cart item already exists'], 400);

         }else {

            if($discount_price =="na") {
                $total_price = $price*$product_quantity;
                $unit_price = $price;
            }else {
                $total_price = $discount_price*$product_quantity;
                $unit_price = $discount_price;
            }
            $request = ProductCart::insert([
                'product_id' => $product_id,
                'user_id'  => $user_id,
                'email' =>  $email,
                'image' =>  $product_image,
                'product_name' =>  $product_title,
                'product_size' =>  $product_size,
                'product_color' =>  $product_color,
                'product_quantity' =>  $product_quantity,
                'total_price' =>  $total_price,
                'unit_price' =>  $unit_price,
                'created_at' => Carbon::now()
    
            ]);
            return response()->json(['success' => 'Item add to cart success'], 200);
         }
    }


    public function cartcount($id) {
        $validatecart = ProductCart::where('user_id',$id)->get();
        $count = $validatecart->count();
        return $count;
    }



    public function getcartitems($id) {
        
        $catartitems  = ProductCart::where('user_id',$id)->get();
        return $catartitems;
    }


}
