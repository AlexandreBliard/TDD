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
}
