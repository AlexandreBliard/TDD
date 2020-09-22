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

    public function testWhoConfirmTitleProjectIsTheSameAsDB() {
        //Livrable : TEST validant la présence du titre d'un projet
        //sur la page liste des objets
        //Given : généré des données avec une factory dans la BDD

        //When : quand j'appelle la page /project

        //Then : alors je confirme le contenu du titre
        // dans la page

    }
}
