<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Http\Request;

class AudiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $audios = Audio::all();

        return view('audios.index', ['audios'=> $audios]);
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
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function show(Audio $audio)
    {

        $audio = Audio::find($audio->id);
        return view('audios.show', ['audio'=>$audio]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function edit(Audio $audio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audio $audio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audio $audio)
    {
        //
    }
}
