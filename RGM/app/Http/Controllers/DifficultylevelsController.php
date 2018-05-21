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
        $difficultylevels = Difficultylevel::all();

        return view('difficultylevels.index', ['difficultylevels'=> $difficultylevels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('difficultylevels.create');
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
                return redirect()->route('difficultylevels.index', ['difficultylevel' => $difficultylevel->id])
                    ->with('success', 'Difficulty level created with success');
            }
        }

        return back()->withInput()->with('error', 'Error creating difficulty level');
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
        $difficultylevel = Difficultylevel::find($difficultylevel->id);

        return view('difficultylevels.edit', ['difficultylevel'=>$difficultylevel]);
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
        $difficultylevelUpdate = Difficultylevel::where('id', $difficultylevel->id)->update([
            'description' => $request->input('description'),
        ]);

        if($difficultylevelUpdate){
            return redirect()->route('difficultylevels.index', ['difficultylevel'=>$difficultylevel->id])
                ->with('success', 'Difficulty Level updated');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Difficultylevel  $difficultylevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Difficultylevel $difficultylevel)
    {
        //
    }


}
