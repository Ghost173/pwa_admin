<?php

namespace App\Http\Controllers\Api;
use App\Models\Api\SiteInfo;
use Illuminate\Support\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteinfoController extends Controller
{
    public function index() {
        $data = SiteInfo::all();
        return $data;
    }
}
