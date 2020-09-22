<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* vers la liste des projets*/
Route::get('/project', [\App\Http\Controllers\ProjectController::class, 'showProjectList'])
->name('project');

/*vers le détail d'un projet*/
Route::get('/project/{id}', [\App\Http\Controllers\ProjectController::class, 'showOneProject'])
    ->name('oneProject');