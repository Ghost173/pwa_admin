<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class ApiSliderController extends Controller
{
    

    public function getSliders() {
        $sliders_list = Slider::where('slider_status',1)->select('id','slider_image')->get();
        return $sliders_list;
    }
}
