<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;


class ProductListController extends Controller
{
    public function productlistremark($remark ) {
        $product_list = ProductList::where('remark',$remark)->get();
        return $product_list;
    }


    public function productlistbycategory($category_id) {
        $product_list_basedon_category = ProductList::where('product_category_id',$category_id)->get();
        return $product_list_basedon_category;
    }


    public function productlistbysubcategory($category_id, $subcategory_id) {
        $product_list_basedon_subcategory = ProductList::where('product_category_id',$category_id)->where('product_subcategory_id',$subcategory_id)->get();
        return ($product_list_basedon_subcategory);
    }

    public function featureProducts () {
        $product_list = ProductList::where('Feature','1')->get();
        return $product_list;
    }
}
