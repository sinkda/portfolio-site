<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_dashboard()
    {
        $this->assertGuest();

        $response = $this->get(route('admin.index'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login.index'));
    }

    public function test_logged_in_user_can_access_dashboard()
    {
        $user = User::factory()->create();

        /** @var mixed $user */
        $response = $this->actingAs($user)->get(route('admin.index'));

        $this->assertAuthenticated();
        $response->assertOk();
        $response->assertSee(config('app.name'));
    }

    public function test_dashboard_menu_has_unread_count_livewire_component()
    {
        $user = User::factory()->create();

        /** @var mixed $user */
        $response = $this->actingAs($user)->get(route('admin.index'));
        $response->assertSeeLivewire('unread-message-counter');
    }
}
