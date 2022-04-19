<?php

namespace Tests\Feature;

use Livewire\Livewire;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTableLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_message_table_shows_data_no_filters()
    {
        $messages = Message::factory()->count(3)->create();

        Livewire::test('message-table')
                    ->assertSet('search', '')
                    ->assertSeeInOrder([
                        $messages->shift()->subject,
                        $messages->shift()->subject,
                        $messages->shift()->subject
                    ]);
    }

    public function test_message_table_filters_data()
    {
        $messages = Message::factory()->count(3)->create();

        Livewire::test('message-table')
                ->set('search', $messages->first()->subject)
                ->assertSee($messages->shift()->subject)
                ->assertDontSee($messages->shift()->subject)
                ->assertDontSee($messages->shift()->subject);
    }

    public function test_message_table_filters_data_with_query_string()
    {
        $messages = Message::factory()->count(3)->create();

        Livewire::withQueryParams(['search' => $messages->first()->subject])
                ->test('message-table')
                ->assertSet('search', $messages->first()->subject)
                ->assertSee($messages->shift()->subject)
                ->assertDontSee($messages->shift()->subject)
                ->assertDontSee($messages->shift()->subject);       
    }

    public function test_message_table_changes_read_to_unread_on_markUnread_emit()
    {
        $message = Message::factory()->create();
        $message->markAsRead();

        $this->assertDatabaseHas('messages', ['read_status' => true]);

        Livewire::test('message-table')
                ->emit('markUnread', $message->id)
                ->assertSee('Unread');

        $this->assertDatabaseHas('messages', ['read_status' => false]);
    }

    public function test_message_table_changes_unread_to_read_on_markRead_emit()
    {
        $message = Message::factory()->create();

        $this->assertDatabaseHas('messages', ['read_status' => false]);

        Livewire::test('message-table')
                ->emit('markRead', $message->id)
                ->assertSee('Read');

        $this->assertDatabaseHas('messages', ['read_status' => true]);
    }

    public function test_message_table_paginates_correctly()
    {
        $messages = Message::factory()->count(11)->create();

        $order = [];
        for($i = 0; $i < 10; $i++)
            $order[] = $messages->shift()->subject;

        Livewire::test('message-table')
            ->assertSet('search', '')
            ->assertSeeInOrder($order)
            ->assertDontSee($messages->shift()->subject);
    }

}
