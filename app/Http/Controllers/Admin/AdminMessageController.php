<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class AdminMessageController extends Controller
{
    public function index()
    {
        return view('admin.list-messages');      
    }

    public function show(Message $message)
    {
        return view('admin.view-message', [
            'message' => $message
        ]);
    }
}
