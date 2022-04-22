<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private array $data;

    public function setUp() : void
    {
        parent::setUp();

        /** @var mixed $user */
        $this->user = User::factory()->create();

        $this->data = [
            'name' => 'Nameo Nameithson',
            'email' => 'nameo@email.com',
            'current_password' => 'password',
            'new_password' => 'mY_Super_Awe$some_Pa55',
            'new_password_confirmation' => 'mY_Super_Awe$some_Pa55'
        ];

        $this->actingAs($this->user);
        $this->call('get', route('admin.profile.show'));
    }

    private function updateProfile($noErrors = false)
    {
        $response = $this->put(route('admin.profile.update'), $this->data);

        if(!$noErrors)
        {
            $response->assertStatus(302);
            $response->assertSessionMissing('success');
        }

        return $response;
    }

    private function setNewPassword($password)
    {
        $this->data['new_password'] = $password;
        $this->data['new_password_confirmation'] = $password;
    }

    public function test_user_can_see_profile_page()
    {
        /** @var mixed $user */
        $response = $this->get(route('admin.profile.show')); 
        $response->assertOk();
        $response->assertSee("Change Password");
    }

    public function test_user_updates_profile_no_errors()
    {
        $response = $this->updateProfile(true);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.profile.show'));
        $response->assertSessionHas('success', true);
    }

    public function test_user_update_error_missing_name()
    {
        unset($this->data['name']);

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['name']);
    }

    public function test_user_update_error_missing_email()
    {
        unset($this->data['email']);

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['email']);      
    }

    public function test_user_update_error_invalid_email()
    {
        $this->data['email'] = 'bad-email';

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_user_update_error_missing_current_password()
    {
        unset($this->data['current_password']);

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['current_password']);             
    }

    public function test_user_update_error_incorrect_current_password()
    {
        $this->data['current_password'] = 'incorrect';

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['current_password']);          
    }

    public function test_user_update_error_missing_new_password()
    {
        unset($this->data['new_password']);

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['new_password']);    
    }

    public function test_user_update_error_missing_confirmation_password()
    {
        unset($this->data['new_password_confirmation']);

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['new_password']);    
    }

    public function test_user_update_error_password_mismatch()
    {
        $this->data['new_password_confirmation'] = 'not_a_match11';

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['new_password']);    
    }

    public function test_user_update_error_new_password_too_short()
    {
        $this->setNewPassword('Too$hor1');

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['new_password']);   
    }

    public function test_user_update_error_new_password_no_mixed_case()
    {
        $this->setNewPassword('some_bad_pa55');

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['new_password']);   

        $this->setNewPassword('SOME_BAD_PA55');

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['new_password']);   
    }

    public function test_user_update_error_new_password_no_numbers()
    {
        $this->setNewPassword('some_bad_pass');

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['new_password']);   
    }

    public function test_user_update_error_new_password_no_symbols()
    {
        $this->setNewPassword('somebadpa55');

        $response = $this->updateProfile(false);
        $response->assertSessionHasErrors(['new_password']);   
    }
}
