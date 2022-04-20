<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminMessagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_message_table_livewire_component()
    {
        $user = User::factory()->create();

        /** @var mixed $user */
        $response = $this->actingAs($user)->get(route('admin.messages.index'));

        $response->assertSeeLivewire('message-table');
    }

    public function test_error_message_shows_when_attempting_to_view_invalid_resource()
    {
        Message::factory()->create();

        $user = User::factory()->create();

        /** @var mixed $user */
        $response = $this->actingAs($user)->get(route('admin.messages.show', 2));

        $response->assertRedirect(route('admin.messages.index'));
        $response->assertSessionHas('missing', true);
    }
}
