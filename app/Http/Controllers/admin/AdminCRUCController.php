<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use DB;

class AdminCRUCController extends Controller
{
    public function adminprofile () {
        $admindata = Auth::user();
        return view('admin.profile.index',compact('admindata'));
    }
}
