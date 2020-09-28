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

    public function testWhoVerifyIDUserAndIDUserProjectIsTheSamePerson() {
        //test validant que seul l'utilisateur d'un projet
        //peut l'éditer/

        //Given : il faut un User et un Project
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $id = $project->id;

        //When : nous désirons changer un project
        $response = $this->actingAs($user)
            ->get("${id}/modifyProject");

        //Then : si les deux id ne sont
        // pas les mêmes cela bloque/
        $response->assertDontSee($project, false);
    }

    public function testWhoValidateSameInfoForFormulaireAddProject() {
        //Créez un test qui vérifiera les données
        // du formulaire qui sera envoyé au serveur/

        //Given : il faut un User et un Project avec données contraintes
        $project = Project::factory([])->create([
            'user_id' => '1',
        ]);
        $user = User::factory()->create();
        //dump($project);
        //dd($user);

        //When : quand on appelle la page confirmAddProject/
        $response = $this->actingAs($user)
            ->post('/confirmAddProject',
            [
                'name' => $project->name,
                'description' => $project->description,
                'created_at' => $project->created_at,
                'author_name' => $project->author_name,
                'user_id' => $project->user_id,
            ]);
        //dd($response);

        //Then : les infos saisies doivent être les mêmes.
        $response->assertSee($project->name, false);
        $response->assertSee($project->description, false);
        $response->assertSee($project->created_at, false);
        $response->assertSee($project->author_name, false);
        $response->assertSee($project->user_id, false);
    }

    public function testWhoValidateSendMail() {
        //le créateur de projet reçoit un mail et moi
        // l'admibistrateur je reçois aussi un mail /
    }
}
