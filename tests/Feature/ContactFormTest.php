<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_access_contact_page()
    {
        $response = $this->get(route('message.index'));

        $response->assertOk();
        $response->assertSee('Contact Me');
    }

    public function test_user_can_submit_contact_form_no_errors()
    {
        $data = [
            'name' => 'Person Name',
            'email' => 'person@example.com',
            'subject' => 'This Person wants to talk to you',
            'message' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus velit aliquam numquam inventore quam, qui possimus minus odit eveniet quas.'
        ];

        $this->call('get', route('message.index'));

        $response = $this->post(route('message.store'), $data);

        $response->assertRedirect(route('message.index'));
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success', true);

        $this->assertDatabaseHas('messages', ['name' => 'Person Name']);
    }

     public function test_contact_name_field_missing()
     {
        $data = [
            'email' => 'person@example.com',
            'subject' => 'This Person wants to talk to you',
            'message' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus velit aliquam numquam inventore quam, qui possimus minus odit eveniet quas.'
        ];

        $response = $this->post(route('message.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $response->assertSessionMissing('success');

        $this->assertDatabaseMissing('messages', ['email' => 'person@example.com']);        
     }

     public function test_contact_email_field_missing()
     {
        $data = [
            'name' => 'Person Name',
            'subject' => 'This Person wants to talk to you',
            'message' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus velit aliquam numquam inventore quam, qui possimus minus odit eveniet quas.'
        ];

        $response = $this->post(route('message.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        $response->assertSessionMissing('success');

        $this->assertDatabaseMissing('messages', ['name' => 'Person Name']);                
     }

     public function test_contact_email_invalid_type()
     {
        $data = [
            'name' => 'Person Name',
            'email' => 'person',
            'subject' => 'This Person wants to talk to you',
            'message' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus velit aliquam numquam inventore quam, qui possimus minus odit eveniet quas.'
        ];

        $response = $this->post(route('message.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        $response->assertSessionMissing('success');

        $this->assertDatabaseMissing('messages', ['name' => 'Person Name']);                
     }

     public function test_contact_subject_field_missing()
     {
        $data = [
            'name' => 'Person Name',
            'email' => 'person',
            'message' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus velit aliquam numquam inventore quam, qui possimus minus odit eveniet quas.'
        ];

        $response = $this->post(route('message.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['subject']);
        $response->assertSessionMissing('success');

        $this->assertDatabaseMissing('messages', ['name' => 'Person Name']);                
     }

     public function test_contact_subject_field_too_short()
     {
        $data = [
            'name' => 'Person Name',
            'email' => 'person',
            'subject' => 'hi',
            'message' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus velit aliquam numquam inventore quam, qui possimus minus odit eveniet quas.'
        ];

        $response = $this->post(route('message.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['subject']);
        $response->assertSessionMissing('success');

        $this->assertDatabaseMissing('messages', ['name' => 'Person Name']);                
     }

     public function test_contact_message_field_missing()
     {
        $data = [
            'name' => 'Person Name',
            'email' => 'person',
            'subject' => 'This person wants to talk to you',
        ];

        $response = $this->post(route('message.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['message']);
        $response->assertSessionMissing('success');

        $this->assertDatabaseMissing('messages', ['name' => 'Person Name']);                
     }

     public function test_contact_message_field_too_short()
     {
        $data = [
            'name' => 'Person Name',
            'email' => 'person',
            'subject' => 'This person wants to talk to you',
            'message' => 'hi'
        ];

        $response = $this->post(route('message.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['message']);
        $response->assertSessionMissing('success');

        $this->assertDatabaseMissing('messages', ['name' => 'Person Name']);                
     }
}
