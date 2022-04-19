<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_anyone_can_access_homepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
