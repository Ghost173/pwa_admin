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
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Carbon;
use Storage;



class ProductController extends Controller
{
    
    // get all products and return to view 
    public function getallproducts() {
        $products  = ProductList::latest()->paginate(10);
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

// Deactivate a product
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


    // add products 
    public function addproduct() {
    $category = Category::orderBy('category_name','ASC')->get();
    $subcategory = SubCategory::orderBy('subcategory_name','ASC')->get();

        return view ('admin.products.addproduct', compact('category', 'subcategory'));
    }

    public function categorysub($product_category_id) {
        $subcat = SubCategory::where('category_id', $product_category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);
    }


    // store products 
    public function storeproduct(Request $request) {
        $validated = $request->validate( [
            'product_image' => 'required',
            'product_title' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_qty' => 'required',
            'image_one' => 'required',
            'image_two' => 'required',
            'image_three' => 'required',
            'image_four' => 'required',
            'image_four' => 'required',
            'product_long_description' => 'required',
            'product_price' => 'required',
        ],
        [
            'product_image.required' => 'we need product thumbnail image ',
        ]);

        $admin = Auth::user();
        $product_title = $request->product_title;
        $product_price = $request->product_price;
        $discount_price = $request->discount_price;
        $product_category_id = $request->product_category_id;
        $product_subcategory_id = $request->product_subcategory_id;
        $product_brand = $request->product_brand;
        $product_code = $request->product_code;
        $product_qty = $request->product_qty;
        $Feature_product = $request->Feature_product;
        $product_collection = $request->product_collection;
        $product_long_description = $request->product_long_description;
        $product_color = $request->product_color;
        $product_size = $request->product_size;

        // Check if $Feature_product is null
    if ($Feature_product === null) {
        // Set the default value to 0
        $Feature_product = 0;
    } else {
        // Set the value to 1
        $Feature_product = 1;
    }

    if ($product_collection === null) {
        // Set the default value to 0
        $product_collection = 0;
    } else {
        // Set the value to 1
        $product_collection = 1;
    }

    if ($product_color === null) {
        // Set the default value to 0
        $product_color = "na";
    } else {
        // Set the value to 1
        $product_color = $request->product_color;
    }

    if ($product_size === null) {
        // Set the default value to 0
        $product_size = "na";
    } else {
        // Set the value to 1
        $product_size = $request->product_size;
    }


// product thumbnail work here
        $product_image = $request->file('product_image');
        $name_gen_product_image = hexdec(uniqid()) . '.' . $product_image->getClientOriginalExtension();
        $image = Image::make($product_image)->resize(711,960);
        $tempPath_productimgPath = 'upload/tests3/' . $name_gen_product_image ;
        $image->save($tempPath_productimgPath);

        $s3Path_product = 'product_images/thumbnail/';
        $urlpath_product =  'product_images/thumbnail/' . $name_gen_product_image;
        Storage::disk('s3')->putFileAs($s3Path_product, $tempPath_productimgPath,$name_gen_product_image);
        unlink($tempPath_productimgPath);
        $publicUrl_product_image = Storage::cloud('s3')->url($urlpath_product);


// product extra image one 
        $image_one = $request->file('image_one');
        $name_gen_image_one = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
        $image = Image::make($image_one)->resize(711,960);
        $tempPath_image_onePath = 'upload/tests3/' . $name_gen_image_one ;
        $image->save($tempPath_image_onePath);

        $s3Path_imageone = 'product_images/image_one/';
        $urlpath_imageone =  'product_images/image_one/' . $name_gen_image_one;
        Storage::disk('s3')->putFileAs($s3Path_imageone, $tempPath_image_onePath,$name_gen_image_one);
        unlink($tempPath_image_onePath);
        $publicUrl_image1 = Storage::cloud('s3')->url($urlpath_imageone);


// product extra image two 
$image_two = $request->file('image_two');
$name_gen_image_two = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
$image = Image::make($image_two)->resize(711,960);
$tempPath_image_twoPath = 'upload/tests3/' . $name_gen_image_two ;
$image->save($tempPath_image_twoPath);
$s3Path_image_two = 'product_images/image_two/';
$urlpath_image_two =  'product_images/image_two/' . $name_gen_image_two;
Storage::disk('s3')->putFileAs($s3Path_image_two, $tempPath_image_twoPath,$name_gen_image_two);
unlink($tempPath_image_twoPath);
$publicUrl_image2 = Storage::cloud('s3')->url($urlpath_image_two);

// product extra image three 
$image_three = $request->file('image_three');
$name_gen_image_three = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
$image = Image::make($image_three)->resize(711,960);
$tempPath_image_threePath = 'upload/tests3/' . $name_gen_image_three ;
$image->save($tempPath_image_threePath);

$s3Path_image_three = 'product_images/image_three/';
$urlpath_image_three =  'product_images/image_three/' . $name_gen_image_three;
Storage::disk('s3')->putFileAs($s3Path_image_three, $tempPath_image_threePath,$name_gen_image_three);
unlink($tempPath_image_threePath);
$publicUrl_image3 = Storage::cloud('s3')->url($urlpath_image_three);


// product extra image four 
$image_four = $request->file('image_four');
$name_gen_image_four = hexdec(uniqid()) . '.' . $image_four->getClientOriginalExtension();
$image = Image::make($image_four)->resize(711,960);
$tempPath_image_fourPath = 'upload/tests3/' . $name_gen_image_four ;
$image->save($tempPath_image_fourPath);

$s3Path_image_four = 'product_images/image_four/';
$urlpath_image_four =  'product_images/image_four/' . $name_gen_image_four;
Storage::disk('s3')->putFileAs($s3Path_image_four, $tempPath_image_fourPath,$name_gen_image_four);
unlink($tempPath_image_fourPath);
$publicUrl_image4 = Storage::cloud('s3')->url($urlpath_image_four);

        if ($discount_price === null) {
             $porduct_id = ProductList::insertGetId([
                'product_title' => $product_title,
                'product_price' => $product_price,
                'product_category_id' => $product_category_id,
                'product_subcategory_id' => $product_subcategory_id,
                'product_brand' => $product_brand,
                'product_code' => $product_code,
                'product_qty' => $product_qty,
                'Feature_product' => $Feature_product,
                'product_collection' => $product_collection,
                'product_image' => $publicUrl_product_image ,
                'product_image_s3_location' => $urlpath_product,
                'product_view'  => 1,
                'product_add_user' => $admin->id,
                'created_at' => Carbon::now(),
                'discount_price' => "na"
            ]);

            productDetails::insert([
                'product_id' => $porduct_id,
                'image_one' => $publicUrl_image1,
                'image_one_s3' => $urlpath_imageone,
                'image_two' => $publicUrl_image2,
                'image_two_s3' => $urlpath_image_two,
                'image_three' => $publicUrl_image3,
                'image_three_s3' => $urlpath_image_three,
                'image_four' => $publicUrl_image4,
                'image_four_s3' => $urlpath_image_four,
                'product_long_description' => $product_long_description,
                'product_color' => $product_color,
                'product_size' => $product_size,
                'created_at' => Carbon::now(),
            ]);


            

        } else {
            $porduct_id = ProductList::insertGetId([
                'product_title' => $product_title,
                'product_price' => $product_price,
                'product_category_id' => $product_category_id,
                'product_subcategory_id' => $product_subcategory_id,
                'product_brand' => $product_brand,
                'product_code' => $product_code,
                'product_qty' => $product_qty,
                'Feature_product' => $Feature_product,
                'product_collection' => $product_collection,
                'product_image' => $publicUrl_product_image ,
                'product_image_s3_location' => $urlpath_product,
                'product_view'  => 1,
                'product_add_user' => $admin->id,
                'created_at' => Carbon::now(),
                'discount_price' => $discount_price
            ]);

            productDetails::insert([
                'product_id' => $porduct_id,
                'image_one' => $publicUrl_image1,
                'image_one_s3' => $urlpath_imageone,
                'image_two' => $publicUrl_image2,
                'image_two_s3' => $urlpath_image_two,
                'image_three' => $publicUrl_image3,
                'image_three_s3' => $urlpath_image_three,
                'image_four' => $publicUrl_image4,
                'image_four_s3' => $urlpath_image_four,
                'product_long_description' => $product_long_description,
                'product_color' => $product_color,
                'product_size' => $product_size,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => '	product added success',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallproducts')->with($notification);

    }



    // delete product
    public function deleteproduct($id) {
        $productlist = ProductList::findorFail($id);
        $getcartdeltes = ProductCart::where('product_id',$id)->get();
        foreach($getcartdeltes as $cartodr) {
            $resultdelete = ProductCart::where('id',$cartodr->id)->delete();
        }
        $getoders = Orders::where('product_id',$id)->get();
        foreach($getoders as $cartodr) {
            Orders::where('id',$cartodr->id)->delete();
        }

        $getreviews = ProductReview::where('product_id',$id)->get();
        foreach($getreviews as $cartodr) {
            ProductReview::where('id',$cartodr->id)->delete();
        }
        if($productlist->product_image_s3_location) {
            Storage::disk('s3')->delete($productlist->product_image_s3_location);
        }
        ProductList::where('id',$id)->delete();

        $productdetails = productDetails::where('id',$id)->first();
        if($productdetails->image_one_s3) {
            Storage::disk('s3')->delete($productdetails->image_one_s3);
        }
        if($productdetails->image_two_s3) {
            Storage::disk('s3')->delete($productdetails->image_two_s3);
        }
        if($productdetails->image_three_s3) {
            Storage::disk('s3')->delete($productdetails->image_three_s3);
        }
        if($productdetails->image_four_s3) {
            Storage::disk('s3')->delete($productdetails->image_four_s3);
        }
        $notification = array(
            'message' => '	product delete success',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallproducts')->with($notification);
    }
}
