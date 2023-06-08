<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminCRUCController extends Controller
{
    public function adminprofile () {
        $admindata = Auth::user();
        return view('admin.profile.index',compact('admindata'));
    }



    public function adminprofilestore (Request $request) {

        $admin = Auth::user();

        $validated = $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:admins,email,'.$admin->id,
            'phone' => 'required|string',
        ],
        [
            'name.required' => 'name cant be empty',
            'email.required' => 'email cant be empty',
            'phone.required' => 'phone cant be empty',
        ]);

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $image = $request->file('image');

        if($image) {
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(110,110)->save('upload/profile/'.$name_gen);
            $save_url = 'upload/profile/'.$name_gen;

            $oldimge = $admin->profile_photo_path;
            if(file_exists($oldimge)) {
                unlink($oldimge);
            }

            Admin::where('id',$admin->id)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'profile_photo_path' => $save_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'profile updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.profile')->with($notification);
        }else {
            Admin::where('id',$admin->id)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,       
                'updated_at' => Carbon::now()         
            ]);
            $notification = array(
                'message' => 'profile updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.profile')->with($notification);
        }

    }


    //update password for admins 
    public function adminpasswordstore (Request $request) {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',

        ]);
        $hashedpassword = Auth::user()->password;

        if (Hash::check($request->current_password, $hashedpassword)) {
            $user = Admin::find(Auth::id());

            $user->password =  Hash::make($request->password);

            $user->save();

            Auth::logout();

            return redirect()->route('admin.loginform');
        } else {

            $notification = array(
                'message' => 'entered Current password is wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
