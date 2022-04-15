<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_access_login_page()
    {
        $response = $this->get(route('login.index'));

        $this->assertGuest();
        $response->assertOk();
        $response->assertSee('Sign In');
    }

    public function test_logged_in_user_cannot_access_login_page()
    {
        $user = User::factory()->create();

        /** @var mixed $user */
        $response = $this->actingAs($user)->get(route('login.index'));

        $this->assertAuthenticated();
        $response->assertRedirect(route('home'));
    }

    public function test_logged_in_user_can_logout()
    {
        $user = User::factory()->create();

        /** @var mixed $user */
        $response = $this->actingAs($user)->post(route('logout'));

        $this->assertGuest();

        $response->assertRedirect(route('login.index'));
    }

    public function test_guest_can_login_no_errors()
    {
        $userInfo = [
            'email' => 'test@email.com',
            'password' => 'testtest'
        ];

        $user = User::factory()->create($userInfo);

        $this->assertGuest();

        $response = $this->post(route('login.action'), $userInfo);

        $response->assertSessionHasNoErrors();

        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_email_for_login_fails()
    {
        $userInfo = [
            'email' => 'test@email.com',
            'password' => 'testtest'
        ];

        User::factory()->create($userInfo);

        $this->assertGuest();

        $userInfo['email'] = 'test@example.com';

        $response = $this->post(route('login.action'), $userInfo);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        
        $this->assertGuest();
    }

    public function test_invalid_email_format_fails()
    {
        $userInfo = [
            'email' => 'test@email.com',
            'password' => 'testtest'
        ];

        User::factory()->create($userInfo);

        $this->assertGuest();

        $userInfo['email'] = 'test';

        $response = $this->post(route('login.action'), $userInfo);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        
        $this->assertGuest();
    }

    public function test_missing_email_fails()
    {
        $userInfo = [
            'email' => 'test@email.com',
            'password' => 'testtest'
        ];

        User::factory()->create($userInfo);

        $this->assertGuest();

        unset($userInfo['email']);

        $response = $this->post(route('login.action'), $userInfo);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        
        $this->assertGuest();
    }

    public function test_missing_password_fails()
    {
        $userInfo = [
            'email' => 'test@email.com',
            'password' => 'testtest'
        ];

        User::factory()->create($userInfo);

        $this->assertGuest();

        unset($userInfo['password']);

        $response = $this->post(route('login.action'), $userInfo);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);
        
        $this->assertGuest();       
    }

    public function test_wrong_password_on_login()
    {
        $userInfo = [
            'email' => 'test@email.com',
            'password' => 'testtest'
        ];

        User::factory()->create($userInfo);

        $this->assertGuest();

        $userInfo['password'] = 'test';

        $response = $this->post(route('login.action'), $userInfo);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        
        $this->assertGuest();            
    }
}
