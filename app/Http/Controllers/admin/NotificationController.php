<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;


class NotificationController extends Controller
{

    public function getallnotificatiuons() {
        $notification = Notification::latest()->get();
        return view('admin.notifications.index',compact('notification'));
    }


    public function notificationdeactive($id) {
        $notificationstatus = Notification::findorFail($id)->update([
            'status' => 0,
            'updated_at' => Carbon::now(),   
        ]);

        $notification = array(
            'message' => 'this Notification is now disable',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function notificationactive($id) {
        $notificationstatus = Notification::findorFail($id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),   
        ]);

        $notification = array(
            'message' => 'this Notification is now Active',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



    public function addnotification() {
        return view('admin.notifications.add');
    }



    public function storenotification(Request $request) {
        $validated = $request->validate( [
            'title' => 'required',
            'message' => 'required',
        ],
        [
            'title.required' => 'title name cant be empty',
            'message.required' => 'notification message cant be empty',
        ]);

        date_default_timezone_set("Asia/Colombo");
        $date = date("d-m-y");
        $result = Notification::insert([
            'title' => $request->title,
            'message' => $request->message,
            'status' => 1,
            'date' => $date,
            'created_at' =>Carbon::now()
        ]);

        $notification = array(
            'message' => 'Notification was successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.getallnotificatiuons')->with($notification);
    }
   
}
