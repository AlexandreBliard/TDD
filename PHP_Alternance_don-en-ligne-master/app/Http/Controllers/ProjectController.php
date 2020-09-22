<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function showProjectList() {
        $allProjects = Project::all();
        return view('project')->with('allProjects', $allProjects);
    }

    public function showOneProject($id) {
        $oneProject = Project::find($id);
        return view('oneProject')->with('oneProject', $oneProject);
    }
}
