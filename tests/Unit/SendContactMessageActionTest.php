<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Actions\SendContactMessageAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PDOException;

class SendContactMessageActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_contact_action_success()
    {
       $data = [
           'name' => 'Person Name',
           'email' => 'person',
           'subject' => 'This person wants to talk to you',
           'message' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus velit aliquam numquam inventore quam, qui possimus minus odit eveniet quas.'
        ];

        $contact = new SendContactMessageAction();

        $return = $contact->handle($data);

        $this->assertTrue($return);
    }

    public function test_send_contact_action_missing_data_failure()
    {
        $data = [
            'email' => 'person',
            'subject' => 'This person wants to talk to you',
            'message' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus velit aliquam numquam inventore quam, qui possimus minus odit eveniet quas.'
        ];
 
        $contact = new SendContactMessageAction();
 
        $this->expectException(PDOException::class);

        $contact->handle($data);   
    }
}
