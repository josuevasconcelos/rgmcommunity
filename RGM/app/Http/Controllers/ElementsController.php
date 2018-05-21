<?php

namespace App\Http\Controllers;

use App\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class ElementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Element::all();

        return view('elements.index', ['elements'=> $elements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('elements.create');
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
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save( public_path('/uploads/elements/' . $filename) );

                $element = Element::create([
                    'name' => $request->input('name'),
                    'image' => $filename,
                ]);

                if($element){
                    return redirect()->route('elements.index', ['element' => $element->id])
                        ->with('success', 'Element created');
                }
            }

            return back()->withInput()->with('error', 'Error creating');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Element  $element
     * @return \Illuminate\Http\Response
     */
    public function show(Element $element)
    {
        $element = Element::find($element->id);
        return view('elements.show', ['element'=>$element]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Element  $element
     * @return \Illuminate\Http\Response
     */
    public function edit(Element $element)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Element  $element
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Element $element)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Element  $element
     * @return \Illuminate\Http\Response
     */
    public function destroy(Element $element)
    {
        //
    }

    public function searchElement(Request $request){
        if($request->ajax()){
            $output = "";
            $elements = DB::table('elements')->where('name', 'LIKE', '%'.$request->searchElement.'%')->get();

            foreach ($elements as $key => $element){
                $output .= '<li class="list-group-item">'. $element->name .
                    ' <a href="/elements/' . $element->id .
                    '">View Details</a> | <a href="/elements/' . $element->id  .
                    '/edit">Edit</a></li>';
            }

            return Response($output);
        }
    }
}
