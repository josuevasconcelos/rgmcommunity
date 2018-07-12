<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $types = Type::paginate(5);

            return view('types.index', ['types'=> $types]);
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
            return view('types.create');
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

            $type = Type::create([
                'description' => $request->input('description'),
            ]);

            if ($type) {
                session()->flash('success_notification', 'Type created successfully');

                return redirect()->route('types.index');
            } else {
                session()->flash('error_notification', 'Error creating Type');

                return redirect()->route('types.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        if(Auth::check()){
            $type = Type::find($type->id);

            return view('types.edit', ['type'=>$type]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        if(Auth::check()){
            $typeUpdate = Type::where('id', $type->id)->update([
                'description' => $request->input('description'),
            ]);

            if($typeUpdate){
                session()->flash('success_notification', 'Type updated successfully');

                return redirect()->route('types.index');
            }
            else{
                session()->flash('error_notification', 'Error updating Type');

                return redirect()->route('types.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        //
    }

    public function searchType(Request $request){
        if($request->ajax()){
            $output = "";
            $types = DB::table('types')->where('description', 'LIKE', '%'.$request->searchType.'%')->get();

            if($types->count() == 0){
                $output .= '<ul class="list-group" id="error">
                                <li class="list-group-item" id="searchNotFoundText">Types not found</li>
                            </ul>';

                return Response($output);
            }

            if($types){
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

                foreach ($types as $key => $type){
                    $output .= '<tr>
                                    <td>' . $type->id . '</td>
                                    <td>' . $type->description . '</td>
                                    <td class="buttonOnCenter">
                                        <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/types/' . $type->id . '/edit">Edit</a></button>
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
