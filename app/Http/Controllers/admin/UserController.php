<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use DB;

class UserController extends Controller
{
    public function index() {
        $user = User::latest()->paginate(100);
        return view('admin.user.index',compact('user'));
    }
}
