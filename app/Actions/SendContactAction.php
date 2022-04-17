<?php

namespace App\Actions;

use App\Models\Contact;

class SendContactAction
{
    public function handle(array $contact)
    {
        Contact::create($contact);

        // TODO:  Send Email Notification
    }
}