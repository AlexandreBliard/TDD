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

        if (\Auth::check()) {
            return view('addProject');
        }else {
            return view('project');
        }

    }
}
