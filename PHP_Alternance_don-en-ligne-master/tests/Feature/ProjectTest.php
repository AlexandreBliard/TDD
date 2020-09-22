<?php

namespace Tests\Feature;

use App\Models\Project;
use \Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    use RefreshDatabase;

    public function testHTTPProject()
    {
        $response = $this->get('/project');

        $response->assertStatus(200);
    }

    public function testTagH1InProject() {
        Project::factory()->create();
        $response = $this->get('/project');
        $value = '<h1>Liste des projets</h1>';
        $response
            ->assertSee($value, false);
    }

    public function testWhoConfirmTitleProjectIsTheSameAsDB() {
        //Livrable : TEST validant la présence du titre d'un projet
        //sur la page liste des objets
        //Given : généré des données avec une factory dans la BDD
        $data = Project::factory()
            ->create();
        //When : quand j'appelle la page /project
        $response = $this->get('/project');
        //Then : alors je confirme le contenu du titre
        // dans la page
        $response->assertSee($data->name, false);
    }

    public function testWhoConfirmTitleInProjectDetail() {
        //Livrable : TEST validant la présence du titre d'un projet
        // sur la page de détail du projet
        //Given : généré des données avec une factory
    }
}
