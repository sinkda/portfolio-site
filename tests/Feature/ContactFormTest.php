<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    private array $data;

    public function setUp() : void 
    {
        parent::setUp();

        $this->data = [
            'name' => 'Person Name',
            'email' => 'person@example.com',
            'subject' => 'This Person wants to talk to you',
            'message' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus velit aliquam numquam inventore quam, qui possimus minus odit eveniet quas.'
        ];

        $this->call('get', route('message.index'));
    }

    private function submitContactMessage($noErrors = false)
    {
        $response = $this->post(route('message.store'), $this->data);

        if(!$noErrors)
        {
            $response->assertStatus(302);   
            $response->assertSessionMissing('success');
        }

        return $response;
    }

    public function test_user_can_access_contact_page()
    {
        $response = $this->get(route('message.index'));

        $response->assertOk();
        $response->assertSee('Contact Me');
    }

    public function test_user_can_submit_contact_form_no_errors()
    {
        $response = $this->submitContactMessage(true);

        $response->assertRedirect(route('message.index'));
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success', true);

        $this->assertDatabaseHas('messages', ['name' => $this->data['name']]);
    }

     public function test_contact_name_field_missing()
     {
        unset($this->data['name']);

        $response = $this->submitContactMessage();
        $response->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('messages', ['email' => $this->data['email']]);        
     }

     public function test_contact_email_field_missing()
     {
        unset($this->data['email']);

        $response = $this->submitContactMessage();
        $response->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('messages', ['name' => $this->data['name']]);                
     }

     public function test_contact_email_invalid_type()
     {
        $this->data['email'] = 'person';

        $response = $this->submitContactMessage();
        $response->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('messages', ['name' => $this->data['name']]);                
     }

     public function test_contact_subject_field_missing()
     {
        unset($this->data['subject']);

        $response = $this->submitContactMessage();
        $response->assertSessionHasErrors(['subject']);

        $this->assertDatabaseMissing('messages', ['name' => $this->data['name']]);                
     }

     public function test_contact_subject_field_too_short()
     {
        $this->data['subject'] = 'hi';

        $response = $this->submitContactMessage();
        $response->assertSessionHasErrors(['subject']);

        $this->assertDatabaseMissing('messages', ['name' => $this->data['name']]);                
     }

     public function test_contact_message_field_missing()
     {
        unset($this->data['message']);

        $response = $this->submitContactMessage();
        $response->assertSessionHasErrors(['message']);

        $this->assertDatabaseMissing('messages', ['name' => $this->data['name']]);                
     }

     public function test_contact_message_field_too_short()
     {
        $this->data['message'] = 'hi';

        $response = $this->submitContactMessage();
        $response->assertSessionHasErrors(['message']);

        $this->assertDatabaseMissing('messages', ['name' => $this->data['name']]);                
     }
}
