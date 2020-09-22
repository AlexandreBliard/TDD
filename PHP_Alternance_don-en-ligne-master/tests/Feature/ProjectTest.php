<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    public function testHTTPProject()
    {
        $response = $this->get('/project');

        $response->assertStatus(200);
    }

    public function testTagH1InProject() {

        $response = $this->get('/project');
        $value = '<h1>Liste des projets</h1>';
        $response
            ->assertSee($value, false);
    }
}
