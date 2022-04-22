<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class AdminProjectCreateTest extends TestCase
{
    use RefreshDatabase;

    private array $data;

    public function setUp() : void
    {
        parent::setUp();

        $user = User::factory()->create();

        /** @var mixed $user */
        $this->actingAs($user);
        $this->call('get', route('admin.projects.create'));

        Storage::fake('projects');

        $this->data = [
            'name' => 'My Awesome Project',
            'live_link' => 'https://my-awesome-site.com',
            'code_link' => 'https://my-awesome-site.com',
            'description' => 'This is a really awesome projects! You should check it out',
            'contribution' => 'I did all the things for the project! You should check it out',
            'slug' => 'my-awesome-project',
            'show' => true,
            'image' => UploadedFile::fake()->image('my-fake-image.png')
        ];  
    }

    private function callStoreWithData()
    {
        $response = $this->post(route('admin.projects.store'), $this->data);
        $response->assertRedirect(route('admin.projects.create'));

        return $response;
    }

    public function test_user_can_view_create_form()
    {
        $response = $this->get(route('admin.projects.create'));
        $response->assertOk();
        $response->assertSee("Create New Project");
    }

    public function test_user_can_submit_create_form_no_errors()
    {
        $response = $this->callStoreWithData();
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success', true);

        $this->assertDatabaseHas('projects', ['name' => $this->data['name']]);

        Storage::disk('projects')->assertExists('public/projects/my-awesome-project.png');
    }

    public function test_create_form_fails_missing_name()
    {
        unset($this->data['name']);

        $response = $this->callStoreWithData();
        $response->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('projects', ['live_link' => $this->data['live_link']]);        
    }

    public function test_create_form_fails_short_name()
    {
        $this->data['name'] = 'My';

        $response = $this->callStoreWithData();
        $response->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('projects', ['live_link' => $this->data['live_link']]);
    }

    public function test_create_form_fails_live_link_not_url()
    {
        $this->data['live_link'] = 'some_url';

        $response = $this->callStoreWithData();
        $response->assertSessionHasErrors(['live_link']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_create_form_fails_code_link_not_url()
    {
        $this->data['code_link'] = 'some_url';

        $response = $this->callStoreWithData();
        $response->assertSessionHasErrors(['code_link']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_create_form_fails_description_missing()
    {
        unset($this->data['description']);

        $response = $this->callStoreWithData();
        $response->assertSessionHasErrors(['description']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_create_form_fails_description_too_short()
    {
        $this->data['description'] = 'This';

        $response = $this->callStoreWithData();
        $response->assertSessionHasErrors(['description']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_create_form_fails_contribution_missing()
    {
        unset($this->data['contribution']);

        $response = $this->callStoreWithData();
        $response->assertSessionHasErrors(['contribution']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_create_form_fails_contribution_too_short()
    {
        $this->data['contribution'] = 'I';

        $response = $this->callStoreWithData();
        $response->assertSessionHasErrors(['contribution']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_create_form_fails_image_missing()
    {
        unset($this->data['image']);

        $response = $this->callStoreWithData();
        $response->assertSessionHasErrors(['image']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_create_form_fails_image_not_an_image()
    {
        $this->data['image'] = UploadedFile::fake()->create('some_file.pdf', 60, 'application/pdf');

        $response = $this->callStoreWithData();
        $response->assertSessionHasErrors(['image']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }

    public function test_create_form_fails_image_size_too_large()
    {
        $this->data['image'] = UploadedFile::fake()->create('my-fake-image.png', 2000, 'image/png');

        $response = $this->callStoreWithData();
        $response->assertSessionHasErrors(['image']);

        $this->assertDatabaseMissing('projects', ['name' => $this->data['name']]);
    }
}
