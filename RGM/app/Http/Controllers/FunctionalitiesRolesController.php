<?php

namespace App\Http\Controllers;

use App\Functionality;
use App\FunctionalityRole;
use App\Role;
use Illuminate\Http\Request;

class FunctionalitiesRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $functionalities = Functionality::all();
        $roles = Role::all();
        $functionalitiesroles = FunctionalityRole::all();


        return view('functionalitiesroles.index', ['functionalitiesroles'=> $functionalitiesroles],
            ['functionalities'=>$functionalities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('functionalitiesroles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $functionalityrole = FunctionalityRole::create([
            'functionality_id' => $request->input('functionality_id'),
            'role_id' => $request->input('role_id'),
        ]);

        if($functionalityrole){
            return redirect()->route('functionalitiesroles.index', ['functionalityrole' => $functionalityrole->id])
                ->with('success', 'Company created');
        }

        return back()->withInput()->with('error', 'Error creating');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FunctionalityRole  $functionalityRole
     * @return \Illuminate\Http\Response
     */
    public function show(FunctionalityRole $functionalityRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FunctionalityRole  $functionalityRole
     * @return \Illuminate\Http\Response
     */
    public function edit(FunctionalityRole $functionalityRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FunctionalityRole  $functionalityRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FunctionalityRole $functionalityRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FunctionalityRole  $functionalityRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(FunctionalityRole $functionalityRole)
    {
        //
    }
}
