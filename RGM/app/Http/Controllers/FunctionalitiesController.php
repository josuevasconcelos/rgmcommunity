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
        if(Auth::check()){
            $functionalities = Functionality::paginate(5);

            return view('functionalities.index', ['functionalities'=> $functionalities]);
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
            return view('functionalities.create');
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
        if(Auth::check()) {
            $functionality = Functionality::create([
                'description' => $request->input('description'),
                'url' => $request->input('url'),
            ]);

            if ($functionality) {
                session()->flash('success_notification', 'Functionality created successfully');

                return redirect()->route('functionalities.index');
            } else {
                session()->flash('error_notification', 'Error creating Functionality');

                return redirect()->route('functionalities.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Functionality  $functionality
     * @return \Illuminate\Http\Response
     */
    public function show(Functionality $functionality)
    {
        if(Auth::check()){
            $functionality = Functionality::find($functionality->id);

            return view('functionalities.show', ['functionality'=>$functionality]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Functionality  $functionality
     * @return \Illuminate\Http\Response
     */
    public function edit(Functionality $functionality)
    {
        if(Auth::check()){
            $functionality = Functionality::find($functionality->id);

            return view('functionalities.edit', ['functionality'=>$functionality]);
        }
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
        if(Auth::check()){
            $functionalityUpdate = Functionality::where('id', $functionality->id)->update([
                'description' => $request->input('description'),
            ]);

            if($functionalityUpdate){
                session()->flash('success_notification', 'Functionality updated successfully');

                return redirect()->route('functionalities.index');
            }
            else{
                session()->flash('error_notification', 'Error updating Functionality');

                return redirect()->route('functionalities.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Functionality  $functionality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Functionality $functionality)
    {
        //
    }

    public function searchFunctionality(Request $request){
        if($request->ajax()){
            $output = "";
            $functionalities = DB::table('functionalities')->where('description', 'LIKE', '%'.$request->searchFunctionality.'%')->get();

            if($functionalities->count() == 0){
                $output .= '<ul class="list-group" id="error">
                                <li class="list-group-item" id="searchNotFoundText">Functionalities not found</li>
                            </ul>';

                return Response($output);
            }

            if($functionalities){
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

                foreach ($functionalities as $key => $functionality){
                    $output .= '<tr>
                                    <td>' . $functionality->id . '</td>
                                    <td>' . $functionality->description . '</td>
                                    <td class="buttonOnCenter">
                                        <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/functionalities/' . $functionality->id . '">Edit</a></button>
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
