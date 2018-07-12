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

Route::get('/searchElement', 'ElementsController@searchElement');
Route::get('/searchAudio', 'AudiosController@searchAudio');
Route::get('/searchFunctionality', 'FunctionalitiesController@searchFunctionality');
Route::get('/searchProject', 'ProjectsController@searchProject');
Route::get('/searchAssociation', 'FunctionalitiesRolesController@searchAssociation');
Route::get('/searchRole', 'RolesController@searchRole');
Route::get('/searchUser', 'UsersController@searchUser');
Route::get('/searchTemplate', 'TemplatesController@searchTemplate');
Route::get('/searchDifficultylevel', 'DifficultylevelsController@searchDifficultylevel');
Route::get('/searchType', 'TypesController@searchType');

Route::get('/getTotalOfTemplates', 'TemplatesController@getTotalOfTemplates');
Route::get('/getNumberOfColumns', 'TemplatesController@getNumberOfColumns');
Route::get('/getNumberOfLines', 'TemplatesController@getNumberOfLines');
Route::get('/getNumberOfBlocks', 'TemplatesController@getNumberOfBlocks');

Route::get('/deleteAssociation', 'FunctionalitiesRolesController@deleteAssociation');
Route::get('/deleteProject', 'ProjectsController@deleteProject');