<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectImageUploader extends Component
{
    use WithFileUploads;

    public $image;

    public $previous = false;

    public $passed = false;

    public function updatedImage()
    {
        $this->passed = false;

        $this->validate([
            'image' => ['required', 'image', 'max:1024']
        ]);

        $this->previous = '';
        $this->passed = true;
    }

    public function render()
    {
        return view('livewire.project-image-uploader');
    }
}
