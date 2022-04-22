<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminProjectUpdateTest extends TestCase
{
    use RefreshDatabase;

    private Project $project;
    private array $data;

    public function setUp() : void 
    {
        parent::setUp();

        Storage::fake('projects');

        $this->project = Project::factory()->create();

        $this->data = [
            'id' => $this->project->id,
            'name' => 'My Awesome Project',
            'live_link' => 'https://my-awesome-site.com',
            'code_link' => 'https://my-awesome-site.com',
            'description' => 'This is a really awesome projects! You should check it out',
            'contribution' => 'I did all the things for the project! You should check it out',
            'slug' => 'my-awesome-project',
            'show' => true,
            'image' => UploadedFile::fake()->image('my-fake-image.png')
        ];  

        $user = User::factory()->create();

        /** @var mixed $user */
        $this->actingAs($user);

        $this->call('get', route('admin.projects.edit', $this->project->slug));
    }

    private function putUpdateData($noErrors = false)
    {
        $response = $this->put(route('admin.projects.update'), $this->data);

        if($noErrors)
            $this->project->refresh();

        $response->assertRedirect(route('admin.projects.edit', $this->project->slug));

        return $response;
    }

    public function test_user_can_view_edit_form()
    {
        $response = $this->get(route('admin.projects.edit', $this->project->slug));

        $response->assertOk();
        $response->assertSee("Update Project: {$this->project->name}");
    }

    public function test_user_can_submit_edit_form_no_errors()
    {
        $response = $this->putUpdateData(true);

        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success', true);

        $this->assertDatabaseHas('projects', ['name' => $this->data['name']]);

        Storage::disk('projects')->assertExists('public/projects/my-awesome-project.png');
    }

    public function test_update_form_fails_missing_hidden_id()
    {
        unset($this->data['id']);

        $response = $this->putUpdateData();
        $response->assertSessionHasErrors(['id']);

        $this->assertDatabaseMissing('projects', ['live_link' => $this->data['live_link']]);              
    }

    public function test_update_form_fails_missing_name()
    {
        unset($this->data['name']);

        $response = $this->putUpdateData();
        $response->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('projects', ['live_link' => $this->data['live_link']]);        
    }

    public function test_update_form_fails_short_name()
    {
        $this->data['name'] = 'My';

        $response = $this->putUpdateData();
        $response->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('projects', ['live_link' => $this->data['live_link']]);
    }

    public function test_update_form_fails_live_link_not_url()
    {
        $this->data['live_link'] = 'some_url';

        $response = $this->putUpdateData();
        $response->assertSessionHasErrors(['live_link']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_update_form_fails_code_link_not_url()
    {
        $this->data['code_link'] = 'some_url';

        $response = $this->putUpdateData();
        $response->assertSessionHasErrors(['code_link']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_update_form_fails_description_missing()
    {
        unset($this->data['description']);

        $response = $this->putUpdateData();
        $response->assertSessionHasErrors(['description']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_update_form_fails_description_too_short()
    {
        $this->data['description'] = 'This';

        $response = $this->putUpdateData();
        $response->assertSessionHasErrors(['description']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_update_form_fails_contribution_missing()
    {
        unset($this->data['contribution']);

        $response = $this->putUpdateData();
        $response->assertSessionHasErrors(['contribution']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_update_form_fails_contribution_too_short()
    {
        $this->data['contribution'] = 'I';

        $response = $this->putUpdateData();
        $response->assertSessionHasErrors(['contribution']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_update_form_fails_image_not_an_image()
    {
        $this->data['image'] = UploadedFile::fake()->create('some-file.pdf', 60, 'application.pdf');

        $response = $this->putUpdateData();
        $response->assertSessionHasErrors(['image']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_update_form_fails_image_size_too_large()
    {
 
        $this->data['image'] = UploadedFile::fake()->create('my-fake-image.png', 2000, 'image/png');

        $response = $this->putUpdateData();
        $response->assertSessionHasErrors(['image']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_update_does_not_change_image_when_image_missing()
    {
        unset($this->data['image']);

        $response = $this->putUpdateData(true);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('projects', ['image' => $this->project->image]);
    }
}