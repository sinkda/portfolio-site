<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;
use Livewire\WithPagination;

class MessageTable extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = ['markUnread', 'markRead'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function markUnread(Message $message)
    {
        $message->markAsUnread();
    }

    public function markRead(Message $message)
    {
        $message->markAsRead();
    }

    public function render()
    {
        return view('livewire.message-table', [
            'messages' => Message::where('subject', 'like', "%{$this->search}%")->orWhere('message', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
