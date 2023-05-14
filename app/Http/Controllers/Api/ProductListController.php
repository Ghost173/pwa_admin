<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProducDetails;

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
        ->take(4)->get();
        return $product_colletions_list;
    }


    public function productDetails($product_id) {
        $product_details = ProducDetails::where('product_id',$product_id)->get();
        $product_list = ProductList::where('id',$product_id)->get();

        $data = [
            'product_details' => $product_details,
            'product_list' =>$product_list
        ];

        return $data;
            
    }
}
