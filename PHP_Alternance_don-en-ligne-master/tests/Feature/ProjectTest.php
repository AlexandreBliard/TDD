<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Http;
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
        //Given : généré des données avec une factory dans la BDD
        $data = Project::factory()
            ->create();
        $id =$data->id;

        //When : quand on appelle la page /project/{id}
        $response = $this->get("/project/${id}");//il faut que ici on puisse lui passer les données

        //Then : je dois trouver le même titre dans la page détail
        // que le nom de la BDD
        $response->assertSee($data->name, false);
    }

    public function testWhoValidateIfAuthorNameIsPresentInThePage() {
        //Livrable : Test validant la présence du nom de l'auteur
        //d'un projet sur la page de détails d'un projet/
        //Given : remplir la BDD Product /
        $project = Project::factory()
            ->create();
        $id =$project->id;
        //When : charger la page oneProject
        $response = $this->get("/project/${id}");
        //Then : comparer les deux résultats
        $response->assertSee($project->author_name, false);
    }

    public function testWhoValidateNameUserAuthorOfThisProject() {
        //Livrable : Test validant la présence du nom de l'auteur
        //d'un projet sur la page de détails d'un projet/
        //Given : remplir la BDD Product et User/
        $user = User::factory()
            ->has(Project::factory()->count(2))
            ->create();
        $id = $user->Projects[0]->id;
        //When : charger la page oneProject
        $response = $this->get("/project/${id}");
        $response->assertSee($user->Projects[0]->author_name);
    }

    public function testShowNameUserWhoIsConnected()
        //afficher le nom d'une personne connecté
    {
        //Given : fournir un User
        $user = User::factory()->create();

        //When : en utilisant l'user, se connecter en tant que,
        // dans la page /project/
        $response = $this->actingAs($user)
            ->get('/project');

        // Then : tester qu'on voit le nom de l'utilisateur dans la page'/
        $response->assertSee($user->name);
    }
}
