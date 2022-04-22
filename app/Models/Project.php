<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'live_link', 'code_link', 'description', 'contribution', 'show', 'slug', 'image'];

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function isShown()
    {
        return (bool) $this->show;
    }

    public function hasLiveLink()
    {
        return !is_null($this->live_link);
    }

    public function hasCodeLink()
    {
        return !is_null($this->code_link);
    }

    public function markAsShown()
    {
        $this->show = true;
        $this->save();
    }

    public function markAsHidden()
    {
        $this->show = false;
        $this->save();
    }
}
