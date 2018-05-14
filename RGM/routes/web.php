<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile', 'UsersController@profile');
Route::post('profile', 'UsersController@updateAvatar');

Route::resource('audios', 'AudiosController');
Route::resource('elements', 'ElementsController');
Route::resource('templates', 'TemplatesController');
Route::resource('types', 'TypesController');
Route::resource('difficultylevels', 'DifficultylevelsController');
Route::resource('projects', 'ProjectsController');
Route::resource('profiles', 'ProfilesController');
Route::resource('users', 'UsersController');
Route::resource('roles', 'RolesController');
Route::resource('functionalities', 'FunctionalitiesController');

Route::resource('functionalitiesroles', 'FunctionalitiesRolesController');
Route::resource('elementsprojects', 'ElementsProjectsController');
Route::resource('projectsusers', 'ProjectsUsersController');
