<?php

namespace App\Http\Controllers;

use App\Difficultylevel;
use App\ElementProject;
use App\Project;
use App\Template;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $projects = Project::paginate(5);

            return view('projects.index', ['projects'=> $projects]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            return view('projects.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $name = $request->input('name');
            $audio_id = $request->input('audio_id');
            $template_id = $request->input('template_id');
            $type_id = $request->input('type_id');
            $difficultylevel_id = $request->input('difficultylevel_id');
            $user_id = Auth::user()->id;

            $block_positions = $request->input('block_positions');
            $row_positions = $request->input('row_positions');
            $col_positions = $request->input('col_positions');
            $elements_id = $request->input('elements_id');

            $project = Project::create([
                'name' => $name,
                'audio_id' => $audio_id,
                'template_id' => $template_id,
                'type_id' => $type_id,
                'difficultylevel_id' => $difficultylevel_id,
                'user_id' => $user_id
            ]);

            if($project){
                $project_id = $project->id;

                $arraylength = count($elements_id);

                for($i = 0; $i < $arraylength; $i++) {
                    $elementproject = ElementProject::create([
                        'element_id' => $elements_id[$i],
                        'project_id' => $project_id,
                        'block' => $block_positions[$i],
                        'line' => $row_positions[$i],
                        'column' => $col_positions[$i],
                    ]);
                }

                session()->flash('success_notification', 'Project created successfully');

                return redirect()->route('projects.index');
            }
            else {
                session()->flash('error_notification', 'Error creating Project');

                return redirect()->route('projects.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        if(Auth::check()){
            $project = Project::find($project->id);

            return view('projects.show', ['project'=>$project]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        if(Auth::check()){
            $project = Project::find($project->id);

            return view('projects.edit', ['project'=>$project]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        if(Auth::check()){
            $name = $request->input('name');
            $audio_id = $request->input('audio_id');
            $template_id = $request->input('template_id');
            $type_id = $request->input('type_id');
            $difficultylevel_id = $request->input('difficultylevel_id');
            $user_id = Auth::user()->id;

            $block_positions = $request->input('block_positions');
            $row_positions = $request->input('row_positions');
            $col_positions = $request->input('col_positions');
            $elements_id = $request->input('elements_id');

            $projectUpdate = Project::where('id', $project->id)->update([
                'name' => $name,
                'audio_id' => $audio_id,
                'template_id' => $template_id,
                'type_id' => $type_id,
                'difficultylevel_id' => $difficultylevel_id,
                'user_id' => $user_id
            ]);

            if($projectUpdate) {
                $project_id = $project->id;

                $arraylength = count($elements_id);

                for ($i = 0; $i < $arraylength; $i++) {
                    $elementsprojects = DB::table('element_project')->where('project_id', '=', $project_id)->get();
                    $elementsprojects_count = $elementsprojects->count();

                    for ($j = 0; $j < $elementsprojects_count; $j++) {
                        $element_project = ElementProject::find($elementsprojects[$j]->id);
                        $element_project->delete();
                    }

                    /*$elementproject = ElementProject::create([
                        'element_id' => $elements_id[$i],
                        'project_id' => $project_id,
                        'block' => $block_positions[$i],
                        'line' => $row_positions[$i],
                        'column' => $col_positions[$i],
                    ]);*/
                }
            }

            if($projectUpdate){
                $project_id = $project->id;

                $arraylength = count($elements_id);

                for($i = 0; $i < $arraylength; $i++) {
                    $elementproject = ElementProject::create([
                        'element_id' => $elements_id[$i],
                        'project_id' => $project_id,
                        'block' => $block_positions[$i],
                        'line' => $row_positions[$i],
                        'column' => $col_positions[$i],
                    ]);
                }

                session()->flash('success_notification', 'Project updated successfully');

                return redirect()->route('projects.index');
            }
            else {
                session()->flash('error_notification', 'Error updating Project');

                return redirect()->route('projects.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if(Auth::check()){

            $projectToDelete = Project::find($project->id);

            $projectToDelete->elements()->detach();

            if($projectToDelete->delete()){
                session()->flash('success_notification', 'Difficulty Level deleted with success');

                return redirect()->route('projects.index');
            }
            else{
                session()->flash('error_notification', 'Error deleting Project');

                return redirect()->route('projects.index');
            }
        }
    }

    public function searchProject(Request $request){
        if($request->ajax()){
            $output = "";
            $projects = DB::table('projects')->where('name', 'LIKE', '%'.$request->searchProject.'%')->get();

            if($projects->count() == 0){
                $output .= '<ul class="list-group" id="error">
                                <li class="list-group-item" id="searchNotFoundText">Projects not found</li>
                            </ul>';

                return Response($output);
            }

            if($projects){
                $output .= '<ul class="list-group">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Template</th>
                                            <th>Difficulty Level</th>
                                            <th>Type</th>
                                            <th>Created by</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                foreach ($projects as $key => $project){
                    $template = Template::find($project->template_id);
                    $difficultylevel = Difficultylevel::find($project->difficultylevel_id);
                    $type = Type::find($project->type_id);
                    $user = User::find($project->user_id);

                    $output .= '<tr>
                                    <td>' . $project->id . '</td>
                                    <td>' . $project->name . '</td>
                                    <td>' . $template->name . '</td>
                                    <td>' . $difficultylevel->description . '</td>
                                    <td>' . $type->description . '</td>
                                    <td>' . $user->name . '</td>
                                    <td class="buttonOnCenter">
                                        <button type="button" class="btn btn-primary btn-sm"><a class="textForButton" href="/projects/' . $project->id . '">View Project</a></button>
                                        <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/projects/' . $project->id . '/edit">Edit</a></button>
                                        <button type="button" class="btn btn-danger btn-sm"><a class="delete" id="' . $project->id . '">Delete</a></button>
                                    </td>
                                </tr>';
                }

                $output .= '        </tbody>
                                </table>
                            </ul>';

                return Response($output);
            }
        }
    }

    public function deleteProject(Request $request){
        $project = Project::find($request->input('id'));

        $project->elements()->detach();

        if($project->delete()){
            echo 'Project deleted with success';
        }
    }
}
