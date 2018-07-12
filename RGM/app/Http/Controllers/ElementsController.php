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
        if(Auth::check()){
            $elements = Element::paginate(5);

            return view('elements.index', ['elements'=> $elements]);
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
            return view('elements.create');
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
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save(public_path('/uploads/elements/' . $filename));

                $element = Element::create([
                    'name' => $request->input('name'),
                    'image' => $filename,
                ]);

                if ($element) {
                    session()->flash('success_notification', 'Element created successfully');

                    return redirect()->route('elements.index');
                } else {
                    session()->flash('error_notification', 'Error creating Element');

                    return redirect()->route('elements.index');
                }
            }
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
        if(Auth::check()){
            $element = Element::find($element->id);
            return view('elements.show', ['element'=>$element]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Element  $element
     * @return \Illuminate\Http\Response
     */
    public function edit(Element $element)
    {
        if(Auth::check()){
            $element = Element::find($element->id);
            return view('elements.edit', ['element'=>$element]);
        }
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

        if(Auth::check()) {
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save(public_path('/uploads/elements/' . $filename));

                $element = Element::where('id', $element->id)->update([
                    'name' => $request->input('name'),
                    'image' => $filename,
                ]);

                if ($element) {
                    session()->flash('success_notification', 'Element updated successfully');

                    return redirect()->route('elements.index');
                } else {
                    session()->flash('error_notification', 'Error updating Element');

                    return redirect()->route('elements.index');
                }
            }
        }
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

            if($elements->count() == 0){
                $output .= '<ul class="list-group" id="error">
                                <li class="list-group-item" id="searchNotFoundText">Elements not found</li>
                            </ul>';

                return Response($output);
            }

            if($elements){
                $output .= '<ul class="list-group">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                foreach ($elements as $key => $element){
                    $output .= '<tr>
                                    <td>' . $element->id . '</td>
                                    <td>' . $element->name . '</td>
                                    <td class="buttonOnCenter">
                                        <button type="button" class="btn btn-primary btn-sm"><a class="textForButton" href="/elements/' . $element->id . '">View Element</a></button>
                                        <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/elements/' . $element->id . '">Edit</a></button>
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
