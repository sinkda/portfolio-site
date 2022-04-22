<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Actions\UpdateExistingProjectAction;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateExistingProjectActionTest extends TestCase
{
    use RefreshDatabase;

    private Project $project;
    private array $data;
    private UpdateExistingProjectAction $testAction;

    public function setUp() : void
    {
        parent::setUp();

        $this->project = Project::factory()->create();

        $this->data = [
            'id' => $this->project->id,
            'name' => 'My Awesome Project',
            'live_link' => 'https://my-awesome-site.com',
            'code_link' => 'https://my-awesome-code.com',
            'description' => 'This is a really awesome projects! You should check it out',
            'contribution' => 'I did all the things for the project! You should check it out',
            'show' => true,
            'image' => UploadedFile::fake()->image('my-fake-image.png')
        ];

        $this->testAction = new UpdateExistingProjectAction();

        Storage::fake('projects');

        $this->assertDatabaseCount('projects', 1);
    }

    public function tearDown() : void 
    {
        $this->assertDatabaseCount('projects', 1);
        
        parent::tearDown();
    }

    public function test_update_project_action_success()
    {
        $return = $this->testAction->handle($this->data);

        $this->assertEquals($return->name, $this->project->refresh()->name);
        $this->assertDatabaseCount('projects', 1);
    }

    public function test_update_project_action_sets_show_correctly_to_false()
    {
        $this->project->show = true;
        $this->project->save();

        $this->assertDatabasehas('projects', ['show' => true]);

        unset($this->data['show']);

        $return = $this->testAction->handle($this->data);

        $this->assertEquals($return->name, $this->project->refresh()->name);
        $this->assertDatabaseHas('projects', ['show' => false]);
    }

    public function test_update_project_action_sets_show_correctly_to_true()
    {
        $return = $this->testAction->handle($this->data);

        $this->assertEquals($return->name, $this->project->refresh()->name);
        $this->assertDatabaseHas('projects', ['show' => true]);
    }

    public function test_update_project_action_sets_slug_correctly()
    {
        $return = $this->testAction->handle($this->data);

        $this->assertEquals($return->slug, $this->project->refresh()->slug);
        $this->assertDatabaseHas('projects', ['slug' => 'my-awesome-project']);       
    }

    public function test_update_project_action_sets_image_and_stores_correctly()
    {
        $return = $this->testAction->handle($this->data);

        $this->assertEquals($return->name, $this->project->refresh()->name);
        $this->assertDatabaseHas('projects', ['image' => 'my-awesome-project.png']);

        Storage::disk('projects')->assertExists('public/projects/my-awesome-project.png');
    }

    public function test_update_project_action_skips_missing_image()
    {
        unset($this->data['image']);

        $return = $this->testAction->handle($this->data);
        $this->assertEquals($return->name, $this->project->refresh()->name);
        $this->assertDatabaseHas('projects', ['image' => $this->project->image]);
    }
}
