<?php

namespace App\Actions;

use App\Models\User;

class UpdateUserProfileAction
{
    public function handle(User $user, array $data)
    {
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['new_password'];
        $user->save();

        return true;
    }
}