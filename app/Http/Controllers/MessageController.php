<?php

namespace App\Http\Controllers;

use App\Actions\SendContactMessageAction;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{
    public function index()
    {
        return view('pages.message');
    }

    public function store(MessageRequest $request, SendContactMessageAction $sendContactMessageAction)
    {
        $sendContactMessageAction->handle($request->validated());

        return back()->with('success', true);
    }
}
