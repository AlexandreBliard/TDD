<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function showProjectList() {
        $allProjects = Project::all();
        $user = \Auth::user();
        //dd($user->name);
        return view('project')->with('allProjects', $allProjects)
            ->with('user', $user);
    }

    public function showOneProject($id) {
        $oneProject = Project::find($id);
        return view('oneProject')->with('oneProject', $oneProject);
    }

    public function addProject() {
        $user = \Auth::user();
        return view('addProject')->with('user', $user);
    }

    public function confirmAddProject(Request $request) {

        $addProject = new Project;

        $addProject->name = $request->name;
        $addProject->description = $request->description;
        $addProject->created_at = $request->created_at;
        $addProject->author_name = $request->author_name;
        $addProject->user_id = $request->user_id;
        $addProject->save();

        return view('confirmAddProject')->with('addProject', $addProject);
    }

    public function modifyProject($id) {
        $project = Project::find($id);
        return view('modifyProject')->with('oneProject', $project);
    }

    public function confirmModifyProject(Request $request, $id) {
        //$user = \Auth::user();
        //dd($user->Projects[0]);
        $project = Project::find($id);
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->save();//sauvegarde

        return view('/oneProject')->with('oneProject', $project);
    }
}
