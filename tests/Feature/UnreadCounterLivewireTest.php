<?php

namespace Tests\Feature;

use Livewire\Livewire;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnreadCounterLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_unread_count_component_has_correct_number()
    {
        Message::factory()->count(2)->create();

        Livewire::test('unread-message-counter')->assertSet('unread', 2);
    }

    public function test_unread_count_component_live_updates()
    {
        $messages = Message::factory()->count(2)->create();
  
        Livewire::test('unread-message-counter')
            ->assertSet('unread', 2)
            ->emit('markRead', $messages->first()->id)
            ->assertSet('unread', 1)
            ->emit('markUnread', $messages->first()->id)
            ->assertSet('unread', 2);
    }
}
