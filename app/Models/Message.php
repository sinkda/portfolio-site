<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'subject', 'message'];

    public function markAsRead()
    {
        $this->read_status = true;
        $this->save();
    }

    public function markAsUnread()
    {
        $this->read_status = false;
        $this->save();
    }

    public function isRead()
    {
        return (bool) $this->read_status;
    }

    public function isUnread()
    {
        return (bool) !$this->read_status;
    }
}
