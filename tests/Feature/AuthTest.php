<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private array $userInfo;
    private User $loggedUser;

    public function setUp() : void
    {
        parent::setUp();

        $this->userInfo = [
            'email' => 'test@email.com',
            'password' => 'testtest'
        ];

        $this->loggedUser = User::factory()->create($this->userInfo);
    }

    private function auth()
    {
        $this->actingAs($this->loggedUser);
    }

    private function performLogin($noErrors = false)
    {
        $response = $this->post(route('login.action'), $this->userInfo);

        if(!$noErrors)
            $response->assertStatus(302);

        return $response;
    }

    public function test_guest_can_access_login_page()
    {
        $response = $this->get(route('login.index'));

        $this->assertGuest();
        $response->assertOk();
        $response->assertSee('Sign In');
    }

    public function test_logged_in_user_cannot_access_login_page()
    {
        $this->auth();

        $response = $this->get(route('login.index'));
        $response->assertRedirect(route('home'));

        $this->assertAuthenticated();
    }

    public function test_logged_in_user_can_logout()
    {
        $this->auth();

        $response = $this->post(route('logout'));
        $response->assertRedirect(route('login.index'));

        $this->assertGuest();
    }

    public function test_guest_can_login_no_errors()
    {
        $this->assertGuest();

        $response = $this->performLogin(true);
        $response->assertRedirect(route('admin.index'));
        $response->assertSessionHasNoErrors();

        $this->assertAuthenticatedAs($this->loggedUser);
    }

    public function test_invalid_email_for_login_fails()
    {
        $this->assertGuest();

        $this->userInfo['email'] = 'test@example.com';

        $response = $this->performLogin();
        $response->assertSessionHasErrors(['email']);
        
        $this->assertGuest();
    }

    public function test_invalid_email_format_fails()
    {
        $this->assertGuest();

        $this->userInfo['email'] = 'test';

        $response = $this->performLogin();
        $response->assertSessionHasErrors(['email']);
        
        $this->assertGuest();
    }

    public function test_missing_email_fails()
    {
        $this->assertGuest();

        unset($this->userInfo['email']);

        $response = $this->performLogin();
        $response->assertSessionHasErrors(['email']);
        
        $this->assertGuest();
    }

    public function test_missing_password_fails()
    {
        $this->assertGuest();

        unset($this->userInfo['password']);

        $response = $this->performLogin();
        $response->assertSessionHasErrors(['password']);
        
        $this->assertGuest();       
    }

    public function test_wrong_password_on_login()
    {
        $this->assertGuest();

        $this->userInfo['password'] = 'test';

        $response = $this->performLogin();
        $response->assertSessionHasErrors(['email']);
        
        $this->assertGuest();            
    }
}
