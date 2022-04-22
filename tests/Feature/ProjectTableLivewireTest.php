<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTableLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_table_shows_data_no_filters()
    {
        $projects = Project::factory()->count(3)->create()->sortByDesc('created_at');

        Livewire::test('project-table')
                    ->assertSet('search', '')
                    ->assertSeeInOrder([
                        $projects->shift()->name,
                        $projects->shift()->name,
                        $projects->shift()->name
                    ]);
    }

    public function test_project_table_filters_data()
    {
        $projects = Project::factory()->count(3)->create()->sortByDesc('created_at');

        Livewire::test('project-table')
                ->set('search', $projects->first()->name)
                ->assertSee($projects->shift()->name)
                ->assertDontSee($projects->shift()->name)
                ->assertDontSee($projects->shift()->name);
    }

    public function test_project_table_filters_data_with_query_string()
    {
        $projects = Project::factory()->count(3)->create()->sortByDesc('created_at');

        Livewire::withQueryParams(['search' => $projects->first()->name])
                ->test('project-table')
                ->assertSet('search', $projects->first()->name)
                ->assertSee($projects->shift()->name)
                ->assertDontSee($projects->shift()->name)
                ->assertDontSee($projects->shift()->name);       
    }

    public function test_project_table_changes_show_to_hidden_on_markHide_emit()
    {
        $project = Project::factory()->create();
        $project->markAsShown();

        $this->assertDatabaseHas('projects', ['show' => true]);

        Livewire::test('project-table')
                ->emit('markHide', $project->id)
                ->assertSee('Hidden');

        $this->assertDatabaseHas('projects', ['show' => false]);
    }

    public function test_project_table_changes_hidden_to_shown_on_markShow_emit()
    {
        $project = Project::factory()->create();

        $this->assertDatabaseHas('projects', ['show' => false]);

        Livewire::test('project-table')
                ->emit('markShow', $project->id)
                ->assertSee('Shown');

        $this->assertDatabaseHas('projects', ['show' => true]);
    }

    public function test_project_table_paginates_correctly()
    {
        $projects = Project::factory()->count(11)->create()->sortByDesc('created_at');

        $order = [];
        for($i = 0; $i < 10; $i++)
            $order[] = $projects->shift()->name;

        Livewire::test('project-table')
            ->assertSet('search', '')
            ->assertSeeInOrder($order)
            ->assertDontSee($projects->shift()->name);
    }

    public function test_project_table_shows_individual_view_links()
    {
        $project = Project::factory()->create();

        Livewire::test('project-table')
            ->assertSet('search', '')
            ->assertSeeHtml('<a href="'. route('admin.projects.edit', $project->slug) .'"');
    }
}
