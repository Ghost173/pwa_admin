<?php

namespace App\Models;
use App\Models\ProductList;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function products(){
        return $this->belongsTo(ProductList::class, 'product_id', 'id');
    }
}
