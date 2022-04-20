<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class UnreadMessageCounter extends Component
{
    public $unread = 0;

    protected $listeners = ['markUnread', 'markRead'];

    public function mount()
    {
        $this->unread = Message::where('read_status', 0)->count();
    }

    public function markRead(Message $message)
    {
        $this->unread--;
        $message->markAsRead();
    }

    public function markUnread(Message $message)
    {
        $this->unread++;
        $message->markAsUnread();
    }

    public function render()
    {
            return view('livewire.unread-message-counter');
    }
}
