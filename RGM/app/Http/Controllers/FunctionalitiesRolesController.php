<?php

namespace App\Http\Controllers;

use App\Functionality;
use App\FunctionalityRole;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FunctionalitiesRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $functionalities = Functionality::all();
            $roles = Role::all();
            $functionalitiesroles = FunctionalityRole::paginate(5);

            return view('functionalitiesroles.index', ['functionalitiesroles'=> $functionalitiesroles],
                ['functionalities'=>$functionalities], ['roles'=>$roles]);
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
            return view('functionalitiesroles.create');
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
            $functionalityrole = FunctionalityRole::create([
                'functionality_id' => $request->input('functionality_id'),
                'role_id' => $request->input('role_id'),
            ]);

            if($functionalityrole){
                session()->flash('success_notification', 'Association created successfully');

                return redirect()->route('functionalitiesroles.index');
            }
            else{
                session()->flash('error_notification', 'Error creating Association');

                return redirect()->route('functionalitiesroles.index');
            }
        }
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
    public function edit(FunctionalityRole $functionalityRole, Functionality $functionalities, Role $roles)
    {
        if(Auth::check()){
            $functionalityRole = FunctionalityRole::find($functionalityRole->id);
            $functionalities = Functionality::find($functionalities->id);
            $roles = Role::find($roles->id);

            dd($functionalityRole->id);

            return view('functionalitiesroles.edit', ['functionalityRole'=>$functionalityRole],
                ['functionalities'=>$functionalities], ['roles'=>$roles]);
        }
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
        if(Auth::check()){
            $functionalityRole = FunctionalityRole::where('id', $functionalityRole->id)->update([
                'functionality_id' => $request->input('functionality_id'),
                'role_id' => $request->input('role_id'),
            ]);

            if($functionalityRole){
                session()->flash('success_notification', 'Association updated successfully');

                return redirect()->route('functionalitiesroles.index');
            }
            else{
                session()->flash('error_notification', 'Error updating Association');

                return redirect()->route('functionalitiesroles.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FunctionalityRole  $functionalityrole
     * @return \Illuminate\Http\Response
     */
    public function destroy(FunctionalityRole $functionalityrole)
    {

    }

    public function searchAssociation(Request $request){
        if($request->ajax()){
            $output = "";
                $functionalities = DB::table('functionalities')->where('description', 'LIKE', '%'.$request->searchAssociation.'%')->get();
                $functionalities_count = $functionalities->count();

            if($functionalities_count == 0){
                $output .= '<ul class="list-group" id="error">
                                <li class="list-group-item" id="searchNotFoundText">Associations not found</li>
                            </ul>';

                return Response($output);
            }

            if($functionalities){
                $output .= '<ul class="list-group">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Role</th>
                                            <th>Functionality</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                for($i = 0; $i < $functionalities_count; $i++){
                    $functionalitiesroles = DB::table('functionality_role')->where('functionality_id', '=', $functionalities[$i]->id)->get();
                    $functionalitiesroles_count = $functionalitiesroles->count();
                    for($j = 0; $j < $functionalitiesroles_count; $j++){
                        // .= '<tr><td>' . $functionalities[$i]->description . '</td><td>' . $functionalitiesroles[$j]->id . '</td></tr>';
                        $roles = DB::table('roles')->where('id', '=', $functionalitiesroles[$j]->role_id)->get();
                        $roles_count = $roles->count();
                        for($x = 0; $x < $roles_count; $x++){
                            $output .= '<tr>
                                    <td>' . $functionalitiesroles[$j]->id . '</td>
                                    <td>' . $roles[$x]->description . '</td>
                                    <td>' . $functionalities[$i]->description . '</td>
                                    <td class="buttonOnCenter">
                                        <button type="button" class="btn btn-danger btn-sm"><a class="delete" id="' . $functionalitiesroles[$j]->id . '">Delete</a></button>
                                    </td>
                                </tr>';
                        }
                    }
                }

                $output .= '        </tbody>
                                </table>
                            </ul>';

                return Response($output);
            }
        }
    }

    public function deleteAssociation(Request $request){
        $functionalityRole = FunctionalityRole::find($request->input('id'));

        if($functionalityRole->delete()){
            echo 'Association deleted with success';
        }
    }
}
