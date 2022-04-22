<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectTable extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search' => ['except' => '']];

    protected $listeners = ['markShow', 'markHide'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function markShow(Project $project)
    {
        $project->markAsShown();
    }

    public function markHide(Project $project)
    {
        $project->markAshidden();
    }

    public function render()
    {
        return view('livewire.project-table', [
            'projects' => Project::query()
                                    ->when($this->search, function($query) {
                                        $query->where('name', 'like', "%{$this->search}%")
                                            ->orWhere('description', 'like', "%{$this->search}%");
                                    })
                                    ->latest()
                                    ->paginate(10)
        ]);
    }
}
