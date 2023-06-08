<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;


class Category extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function userName() {
        return $this->belongsTo(Admin::class, 'created_user', 'id');
    }
}
