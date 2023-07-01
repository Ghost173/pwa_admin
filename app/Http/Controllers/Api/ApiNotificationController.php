<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;


class ApiNotificationController extends Controller
{
    //
    public function getNotifications() {
        $data = Notification::where('status',1)->get();
        return  $data;
    }


}
