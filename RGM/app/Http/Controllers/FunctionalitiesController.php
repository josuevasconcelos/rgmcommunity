<?php

namespace App\Http\Controllers;

use App\Functionality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FunctionalitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $functionalities = Functionality::all();

        return view('functionalities.index', ['functionalities'=> $functionalities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('functionalities.create');
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
        if(Auth::check()){
            $functionality = Functionality::create([
                'description' => $request->input('description'),
                'url' => $request->input('url'),
            ]);

            if($functionality){
                return redirect()->route('functionalities.index', ['functionality' => $functionality->id])
                    ->with('success', 'Company created');
            }
        }

        return back()->withInput()->with('error', 'Error creating');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Functionality  $functionality
     * @return \Illuminate\Http\Response
     */
    public function show(Functionality $functionality)
    {
        $functionality = Functionality::find($functionality->id);
        return view('functionalities.show', ['functionality'=>$functionality]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Functionality  $functionality
     * @return \Illuminate\Http\Response
     */
    public function edit(Functionality $functionality)
    {
        //
        $functionality = Functionality::find($functionality->id);
        return view('functionalities.edit', ['functionality'=>$functionality]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Functionality  $functionality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Functionality $functionality)
    {
        $functionalityUpdate = Functionality::where('id', $functionality->id)->update([
            'description' => $request->input('description'),
        ]);

        if($functionalityUpdate){
            return redirect()->route('functionalities.index', ['functionality'=>$functionality->id])
                ->with('success', 'Company updated');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Functionality  $functionality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Functionality $functionality)
    {
        /*
        $findFunctionality = Functionality::find($functionality->id);
        if($findFunctionality->delete()){
            return redirect()->route('functionalities')->with('success', 'Functionality deleted');
        }

        return back()->withInput()->with('error', 'Functionality not deleted');*/
    }

    public function searchFunctionality(Request $request){
        if($request->ajax()){
            $output = "";
            $functionalities = DB::table('functionalities')->where('description', 'LIKE', '%'.$request->searchFunctionality.'%')->get();

            foreach ($functionalities as $key => $functionality){
                $output .= '<li class="list-group-item">'. $functionality->description.
                    ' <a href="/functionalities/' . $functionality->id .
                    '">View Details</a> | <a href="/functionalities/' . $functionality->id  .
                    '/edit">Edit</a></li>';
            }

            return Response($output);
        }
    }
}
