<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Contact;

class MessagesController extends Controller
{
    public function getallmessges() {
        $Contact = Contact::latest()->paginate(10);
        return view('admin.contact.index',compact('Contact'));
    }
}
