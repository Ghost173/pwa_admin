<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCart;
use App\Models\ProductList;
use App\Models\productDetails;
use App\Models\Orders;
use Illuminate\Support\Carbon;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\CartOrders;


class OrderController extends Controller
{
    public function cartorders (Request $request) {

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 401);
        }

        $user = Auth::user();
        
        if($user) {
            $customer_name = $request->customer_name;
            $customer_phone = $request->customer_phone;
            $customer_address = $request->customer_address;
            $payment_method = $request->payment_method;
            date_default_timezone_set("Asia/Colombo");
            $order_time = date("h:i:sa");
            $order_date = date("d-m-y");
            $payment_id = $request->payment_id;

            $sgetproducts = ProductCart::where('user_id',$user->id)->get();

            foreach($sgetproducts as $cartlistitems) {
                $cartinsertdeleteresult = "";
                $orderid = 'PWA' . Str::random(8);
                $invoicenumber = 'INV'  . Str::random(6);
                $insertOrder = Orders::insert([
                    'user_id' => $user->id,
                    'order_id' => $orderid,
                    'invoice_no' => $invoicenumber,
                    'customer_name'=>$customer_name,
                    'customer_email'=>$user->email,
                    'customer_phone' => $customer_phone,
                    'customer_address' => $customer_address,
                    'product_name' => $cartlistitems->product_name,
                    'product_code' => $cartlistitems->product_code,
                    'product_size' => $cartlistitems->product_size,
                    'product_color' => $cartlistitems->product_color,
                    'product_quantity' => $cartlistitems->product_quantity,
                    'product_unit_price' => $cartlistitems->unit_price,
                    'product_total_price' => $cartlistitems->total_price,
                    'product_image' => $cartlistitems->image,
                    'payment_method' => $payment_method,
                    'delivery_charge' => 0,
                    'order_date' =>$order_date,
                    'order_time' => $order_time,
                    'order_status' => 'Pending',
                    'payment_id' => $payment_id,
                    'created_at' => Carbon::now()
                ]);
                if($insertOrder == 1) {
                    $resultdelete = ProductCart::where('id',$cartlistitems->id)->delete();
                    $mailData = [
                        'name' => $customer_name,
                        'quantity' => $cartlistitems->product_quantity,
                        'product_name' => $cartlistitems->product_name,
                        'product_unit_price' => $cartlistitems->unit_price,
                        'product_total_price' => $cartlistitems->total_price,
                        'orderid' => $orderid,
                 ];
                    try {
                    Mail::to($user->email)->send(new CartOrders($mailData));

                    }catch(\Throwable $th) {

                    }

                    if($resultdelete == 1) {
                        $cartinsertdeleteresult=1;
                    }else {
                        $cartinsertdeleteresult=0;
                    }
                }
            }
            return $cartinsertdeleteresult;
        } else {
            return response()->json(['error' => 'please login to continue this '], 409);
        }

           

     
    }



}
