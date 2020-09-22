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
}
