<?php

namespace App\Actions;

use App\Models\Project;
use Illuminate\Support\Str;

class CreateNewProjectAction
{
    private $input;

    public function handle(array $data)
    {
        $this->input = $data;

        // If show is not set, set it.  If it is set, convert to Boolean
        $this->setShow();

        // create the slug
        $this->setSlug();

        //dd($data);
        $this->uploadImage();

        Project::create($this->input);

        return true;
    }

    private function setShow()
    {
        if(!isset($this->input['show']))
            $this->input['show'] = false;
        else
            $this->input['show'] = true;       
    }

    private function setSlug()
    {
        $this->input['slug'] = Str::slug($this->input['name']);
    }

    private function uploadImage()
    {
        $filename = $this->input['slug'] . '.'. $this->input['image']->extension();

        $this->input['image']->storeAs('public/projects', $filename, 'projects');

        $this->input['image'] = $filename;
    }
}