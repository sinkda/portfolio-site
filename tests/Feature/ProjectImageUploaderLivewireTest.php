<?php

namespace Tests\Feature;

use App\Models\Project;
use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectImageUploaderLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_project_page_shows_livewire_component()
    {
        $user = User::factory()->create();

        /** @var mixed $user */
        $response = $this->actingAs($user)->get(route('admin.projects.create'));
        $response->assertSeeLivewire('project-image-uploader');
    }

    public function test_update_project_page_shows_livewire_component()
    {
        $project = Project::factory()->create();
        $user = User::factory()->create();

        /** @var mixed $user */
        $response = $this->actingAs($user)->get(route('admin.projects.edit', $project->slug));
        $response->assertSeeLivewire('project-image-uploader');
    }      

    public function test_uploader_shows_no_previous_image_when_non_provided()
    {
        Livewire::test('project-image-uploader')
            ->assertSet('previous', '')
            ->assertSet('passed', false)
            ->assertDontSeeHtml('<img class="w-64 h-64" src="'. asset('storage/projects/my-fake-image.png') .'">');
    }

    public function test_uploader_shows_previous_image_when_property_set()
    {
        Livewire::test('project-image-uploader', ['previous' => 'my-fake-image.png'])
            ->assertSet('previous', 'my-fake-image.png')
            ->assertSet('passed', false)
            ->assertSeeHtml('<img class="w-64 h-64" src="'. asset('storage/projects/my-fake-image.png') .'">');        
    }

    public function test_uploader_returns_no_errors_on_image_upload_and_shows_image()
    {
        Livewire::test('project-image-uploader')
            ->assertSet('previous', '')
            ->assertSet('passed', false)
            ->assertDontSeeHtml('<img class="w-64 h-64"')
            ->set('image', UploadedFile::fake()->image('my-fake-image.png'))
            ->assertSet('passed', true)
            ->assertSeeHtml('<img class="w-64 h-64"');        
    }

    public function test_uploader_returns_error_and_no_display_on_non_image()
    {
        Livewire::test('project-image-uploader')
            ->assertSet('previous', '')
            ->assertSet('passed', false)
            ->assertDontSeeHtml('<img class="w-64 h-64"')
            ->set('image', UploadedFile::fake()->create('non-image.pdf', 60, 'application/pdf'))
            ->assertSet('passed', false)
            ->assertDontSeeHtml('<img class="w-64 h-64"')
            ->assertHasErrors(['image' => 'image']);        
    }

    public function test_uploader_returns_error_and_no_display_on_large_image()
    {
        Livewire::test('project-image-uploader')
            ->assertSet('previous', '')
            ->assertSet('passed', false)
            ->assertDontSeeHtml('<img class="w-64 h-64"')
            ->set('image', UploadedFile::fake()->create('my-large-imag.png', 2000, 'image/png'))
            ->assertSet('passed', false)
            ->assertDontSeeHtml('<img class="w-64 h-64"')
            ->assertHasErrors(['image' => 'max']);        
    }
}
