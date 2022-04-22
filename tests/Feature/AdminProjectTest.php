<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProjectTest extends TestCase
{
    use RefreshDatabase;

    private Project $project;

    public function setUp() : void 
    {
        parent::setUp();

        $this->project = Project::factory()->create();
        
        $user = User::factory()->create();

        /** @var mixed $user */
        $this->actingAs($user);

        $this->assertDatabaseCount('projects', 1);
    }

    public function test_user_can_see_project_table_livewire_component()
    {
        $response = $this->get(route('admin.projects.index'));

        $response->assertOk();
        $response->assertSeeLivewire('project-table');
    }

    public function test_error_message_shows_when_attempting_to_view_invalid_resource()
    {      
        $response = $this->get(route('admin.projects.edit', 2));

        $response->assertRedirect(route('admin.projects.index'));
        $response->assertSessionHas('missing', true);
    }

    public function test_delete_success_message_shows_when_attemping_to_delete_a_project()
    {
        $response = $this->delete(route('admin.projects.delete', $this->project->slug));

        $response->assertRedirect(route('admin.projects.index'));
        $response->assertSessionHas('deleted', $this->project->name);
    }

    public function test_user_can_delete_a_project()
    {
        $this->delete(route('admin.projects.delete', $this->project->slug));

        $this->assertDatabaseCount('projects', 0);
    }

    public function test_user_can_view_edit_form()
    {
        $response = $this->get(route('admin.projects.edit', $this->project->slug));

        $response->assertOk();
        $response->assertSee("Update Project: {$this->project->name}");
    }
}
