<?php

namespace App\Http\Controllers;

use App\Difficultylevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DifficultylevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $difficultylevels = Difficultylevel::paginate(5);

            return view('difficultylevels.index', ['difficultylevels'=> $difficultylevels]);
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
            return view('difficultylevels.create');
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
            $difficultylevel = Difficultylevel::create([
                'description' => $request->input('description'),
            ]);

            if($difficultylevel){
                session()->flash('success_notification', 'Difficulty Level created successfully');

                return redirect()->route('difficultylevels.index');
            }
            else{
                session()->flash('error_notification', 'Error creating Difficulty Level');

                return redirect()->route('difficultylevels.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Difficultylevel  $difficultylevel
     * @return \Illuminate\Http\Response
     */
    public function show(Difficultylevel $difficultylevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Difficultylevel  $difficultylevel
     * @return \Illuminate\Http\Response
     */
    public function edit(Difficultylevel $difficultylevel)
    {
        if(Auth::check()){
            $difficultylevel = Difficultylevel::find($difficultylevel->id);

            return view('difficultylevels.edit', ['difficultylevel'=>$difficultylevel]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Difficultylevel  $difficultylevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Difficultylevel $difficultylevel)
    {
        if(Auth::check()){
            $difficultylevelUpdate = Difficultylevel::where('id', $difficultylevel->id)->update([
                'description' => $request->input('description'),
            ]);

            if($difficultylevelUpdate){
                session()->flash('success_notification', 'Difficulty Level updated with success');

                return redirect()->route('difficultylevels.index');
            }
            else{
                session()->flash('error_notification', 'Error updating Difficulty Level');

                return redirect()->route('difficultylevels.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Difficultylevel  $difficultylevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Difficultylevel $difficultylevel)
    {
        
    }

    public function searchDifficultylevel(Request $request){
        if($request->ajax()){
            $output = "";
            $difficultylevels = DB::table('difficultyLevels')->where('description', 'LIKE', '%'.$request->searchDifficultylevel.'%')->get();

            if($difficultylevels->count() == 0){
                $output .= '<ul class="list-group" id="error">
                                <li class="list-group-item" id="searchNotFoundText">Difficulty Levels not found</li>
                            </ul>';

                return Response($output);
            }

            if($difficultylevels){
                $output .= '<ul class="list-group">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                foreach ($difficultylevels as $key => $difficultylevel){
                    $output .= '<tr>
                                    <td>' . $difficultylevel->id . '</td>
                                    <td>' . $difficultylevel->description . '</td>
                                    <td class="buttonOnCenter">
                                        <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/difficultylevels/' . $difficultylevel->id . '">Edit</a></button>
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


}
