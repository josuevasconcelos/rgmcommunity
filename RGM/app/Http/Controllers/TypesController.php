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
        $types = Type::all();

        return view('types.index', ['types'=> $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create');
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
            $type = Type::create([
                'description' => $request->input('description'),
            ]);

            if($type){
                return redirect()->route('types.index', ['type' => $type->id])->with('success', 'Type created with success');
            }
        }

        return back()->withInput()->with('error', 'Error creating Type');
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
        $type = Type::find($type->id);

        return view('types.edit', ['type'=>$type]);
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
        $typeUpdate = Type::where('id', $type->id)->update([
            'description' => $request->input('description'),
        ]);

        if($typeUpdate){
            return redirect()->route('types.index', ['type'=>$type->id])
                ->with('success', 'Type updated');
        }

        return back()->withInput();
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

            foreach ($types as $key => $type){
                $output .= '<li class="list-group-item">'. $type->description .
                    ' <a href="/types/' . $type->id .
                    '">View Details</a> | <a href="/types/' . $type->id  .
                    '/edit">Edit</a></li>';
            }

            return Response($output);
        }
    }
}
