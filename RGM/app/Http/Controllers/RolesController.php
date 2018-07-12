<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $roles = Role::paginate(5);

            return view('roles.index', ['roles'=> $roles]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        if(Auth::check()){
            $role = Role::find($role->id);

            return view('roles.show', ['role'=>$role]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }

    public function searchRole(Request $request){
        /*if($request->ajax()){
            $output = "";
            $roles = DB::table('roles')->where('description', 'LIKE', '%'.$request->searchRole.'%')->get();

            foreach ($roles as $key => $role){
                $output .= '<li class="list-group-item">'.
                    '<a href="/roles/' . $role->id .
                    '"/>' . $role->id . ' - ' . $role->description .'</li>';
            }

            return Response($output);
        }*/

        if($request->ajax()){
            $output = "";
            $roles = DB::table('roles')->where('description', 'LIKE', '%'.$request->searchRole.'%')->get();

            if($roles->count() == 0){
                $output .= '<ul class="list-group" id="error">
                                <li class="list-group-item" id="searchNotFoundText">Roles not found</li>
                            </ul>';

                return Response($output);
            }

            if($roles){
                $output .= '<ul class="list-group">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                foreach ($roles as $key => $role){
                    $output .= '<tr>
                                    <td>' . $role->id . '</td>
                                    <td>' . $role->description . '</td>
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
