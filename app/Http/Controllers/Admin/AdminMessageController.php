<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminMessageController extends Controller
{
    public function index()
    {
        return view('admin.list-messages');      
    }
}
