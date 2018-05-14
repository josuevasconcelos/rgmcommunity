<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::all();

        return view('templates.index', ['templates'=> $templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('templates.create');
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
            $template = Template::create([
                'name' => $request->input('name'),
                'numberOfColumns' => $request->input('numberOfColumns'),
                'numberOfLines' => $request->input('numberOfLines'),
                'numberOfBlocks' => $request->input('numberOfBlocks'),
            ]);

            if($template){
                return redirect()->route('templates.index', ['template' => $template->id])
                    ->with('success', 'Template created');
            }
        }

        return back()->withInput()->with('error', 'Error creating');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        $template = Template::find($template->id);
        return view('templates.show', ['template'=>$template]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
}
