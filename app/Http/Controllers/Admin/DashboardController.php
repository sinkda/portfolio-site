<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Actions\UpdateUserProfileAction;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function show()
    {
        return view('admin.profile', [
            'user' => auth()->user()
        ]);
    }

    public function update(ProfileRequest $request, UpdateUserProfileAction $updateUserProfileAction)
    {
        $updateUserProfileAction->handle(auth()->user(), $request->validated());

        return back()->with('success', true);
    }
}
