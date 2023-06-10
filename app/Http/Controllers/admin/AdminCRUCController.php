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
use Storage;


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
        $geturl = request()->getSchemeAndHttpHost();

        if($image) {
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        
            $image = Image::make($image)->resize(110,110);
            $tempPath = 'upload/profile/' . $name_gen ;
            $image->save($tempPath);
            $s3Path = 'upload/profile/';
            $urlpath =  'upload/profile/' . $name_gen;
            Storage::disk('s3')->putFileAs($s3Path, $tempPath,$name_gen);
            unlink($tempPath);
            $publicUrl = Storage::cloud('s3')->url($urlpath);
            $s3_location =  'upload/profile/' . $name_gen;

            if($admin->s3_location) {
                $deleteImage = Storage::disk('s3')->delete($admin->s3_location);
            }
           

            Admin::where('id',$admin->id)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'profile_photo_path' => $publicUrl,
                's3_location' => $s3_location,
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





    public function testbucket() {
        Storage::disk('s3')->put('filea.txt', 'Contents');
        $image = $request->file('image');
    }
}
