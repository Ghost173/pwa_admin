<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class ProductList extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function catgeory(){
        return $this->belongsTo(Category::class, 'product_category_id', 'id');
    }

}
