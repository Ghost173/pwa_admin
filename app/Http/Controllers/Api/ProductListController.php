<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\productDetails;

class ProductListController extends Controller
{
    public function productlistremark($remark ) {
        $product_list = ProductList::where('remark',$remark)->get();
        return $product_list;
    }


    public function productlistbycategory($category_id) {
        $category_name = Category::where('id',$category_id)->select('category_name')->get();
        $product_list_basedon_category = ProductList::where('product_category_id',$category_id)->get();

        $response = [
            'category_name' =>$category_name,
            'product_list_basedon_category' => $product_list_basedon_category
        ];

        return $response;

    }


    public function productlistbysubcategory($category_id, $subcategory_id) {
        $category_name = Category::where('id',$category_id)->select('category_name')->get();
        $subcategory_name = SubCategory::where('id',$subcategory_id)->select('subcategory_name')->get();
       $product_list_basedon_subcategory =  ProductList::where([
            ['product_category_id', '=', $category_id],
            ['product_subcategory_id', '=', $subcategory_id],
            ['product_status', '=', 1]
        ])->get();

        $response = [
            'category_name' => $category_name ,
            'subcategory_name' => $subcategory_name ,
            'product_list_basedon_subcategory' => $product_list_basedon_subcategory,
            
        ];

        return ($response);
    }

    public function featureProducts () {
        $product_list = ProductList::where('Feature_product',1)->where('product_status',1)->latest()
        ->take(6)->get();
        return $product_list;
    }

    public function newarrivals() {
        $newArrival = ProductList::where('product_status', 1)
        ->latest()
        ->limit(10)
        ->get();

        return $newArrival;
    }


    public function productscolletions() {
        $product_colletions_list = ProductList::where('product_collection',1)->where('product_status',1)->latest()
        ->take(6)->get();
        return $product_colletions_list;
    }


    public function SingleproductDetails($product_id) {
        $product_details = productDetails::where('product_id',$product_id)->first();
        $product_list = ProductList::where('id',$product_id)->first();
        $du8mpp = $product_list->product_category_id;
        $product_category = Category::where('id',$product_list->product_category_id)->select('id','category_name')->get();
        $Product_subcategoy = SubCategory::where('id',$product_list->product_subcategory_id)->select('id','subcategory_name')->get();

        $data = [
            'product_details' => $product_details,
            'product_list' =>$product_list,
            'catgeory_name' => $product_category,
            'Product_subcategoy' =>$Product_subcategoy,
        ];

        return $data;
            
    }



    public function suggestproducts($product_id) {
        $product = ProductList::where('id',$product_id)->first();
        $product_catgeory_id = $product->product_category_id;
        $suggest_products = ProductList::where('product_category_id',$product_catgeory_id)->
            inRandomOrder()->limit(6)->get();

        return($suggest_products);
    }




    public function searchProduct($key){
         $productlist = ProductList::where('product_title', 'LIKE',"%{$key}%")->orWhere('product_brand', 'LIKE',"%{$key}%")->orWhere('product_code', 'LIKE',"%{$key}%")->get();
         return $productlist;
    }
}
