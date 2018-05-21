<?php

namespace App\Http\Controllers;

use App\ElementProject;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $projects = Project::all();

        return view('projects.index', ['projects'=> $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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

                return redirect()->route('projects.index', ['project' => $project->id])->with('success', 'Project created with success');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

    }
}
