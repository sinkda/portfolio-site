<?php

namespace App\Http\Controllers;

use App\Actions\SendContactAction;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(ContactRequest $request, SendContactAction $sendContactAction)
    {
        $sendContactAction->handle($request->validated());

        return back()->with('success', true);
    }
}
