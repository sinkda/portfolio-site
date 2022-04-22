<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Actions\CreateNewProjectAction;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Actions\UpdateExistingProjectAction;

class AdminProjectController extends Controller
{
    public function index()
    {
        return view('admin.list-projects');
    }
    
    public function create()
    {
        return view('admin.create-projects');
    }

    public function store(ProjectCreateRequest $request, CreateNewProjectAction $createNewProjectAction)
    {
       $createNewProjectAction->handle($request->validated());

       return back()->with('success', true);
    }


    public function edit(Project $project)
    {
        return view('admin.edit-projects', [
            'project' => $project
        ]);
    }

    public function update(ProjectUpdateRequest $request, UpdateExistingProjectAction $updateExistingProjectAction)
    {
        $project = $updateExistingProjectAction->handle($request->validated());

        return redirect()->route('admin.projects.edit', $project->slug)->with('success', true);
    }

    public function delete(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('deleted', $project->name);
    }
}
