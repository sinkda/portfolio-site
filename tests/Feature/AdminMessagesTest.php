<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMessagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_message_table_livewire_component()
    {
        $user = User::factory()->create();

        /** @var mixed $user */
        $response = $this->actingAs($user)->get(route('admin.messages.list'));

        $response->assertSeeLivewire('message-table');
    }
}
