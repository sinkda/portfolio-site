<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Actions\CreateNewProjectAction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateNewProjectActionTest extends TestCase
{
    use RefreshDatabase;

    private array $data;
    private CreateNewProjectAction $testAction;

    public function setUp() : void 
    {
        parent::setUp();

        Storage::fake('projects');

        $this->data = [
            'name' => 'My Awesome Project',
            'live_link' => 'https://my-awesome-site.com',
            'code_link' => 'https://my-awesome-code.com',
            'description' => 'This is a really awesome projects! You should check it out',
            'contribution' => 'I did all the things for the project! You should check it out',
            'show' => '1',
            'image' => UploadedFile::fake()->image('my-fake-image.png')
        ];

        $this->testAction = new CreateNewProjectAction();

        $this->assertDatabaseCount('projects', 0);
    }

    public function tearDown() : void
    {
        $this->assertDatabaseCount('projects', 1);

        parent::tearDown();
    }

    public function test_create_new_project_action_success()
    {
        $return = $this->testAction->handle($this->data);

        $this->assertTrue($return);
    }

    public function test_create_new_project_action_sets_show_correctly_to_false()
    {
        unset($this->data['show']);

        $return = $this->testAction->handle($this->data);

        $this->assertTrue($return);
        $this->assertDatabaseHas('projects', ['show' => false]);
    }

    public function test_create_new_project_action_sets_show_correctly_to_true()
    {
        $return = $this->testAction->handle($this->data);

        $this->assertTrue($return);
        $this->assertDatabaseHas('projects', ['show' => true]);
    }

    public function test_create_new_project_action_sets_slug_correctly()
    {
        $return = $this->testAction->handle($this->data);

        $this->assertTrue($return);
        $this->assertDatabaseHas('projects', ['slug' => 'my-awesome-project']);       
    }

    public function test_create_new_project_action_sets_image_and_stores_correctly()
    {
        $return = $this->testAction->handle($this->data);

        $this->assertTrue($return);
        $this->assertDatabaseHas('projects', ['image' => 'my-awesome-project.png']);

        Storage::disk('projects')->assertExists('public/projects/my-awesome-project.png');
    }
}
