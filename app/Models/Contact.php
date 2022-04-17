<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'subject', 'message'];

    public function Status()
    {
        return $this->read_status;
    }

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
}
