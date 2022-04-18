<?php

namespace App\Actions;

use App\Models\Message;

class SendContactMessageAction
{
    public function handle(array $contact)
    {
        Message::create($contact);

        // TODO:  Send Email Notification

        return true;
    }
}