<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AudiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        return view('audios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        if(Auth::check()) {
            if ($request->hasFile('song')) {
                $song = $request->file('song');
                $filename = time() . '.' . $song->getClientOriginalExtension();
                $song->move(public_path('/uploads/audios'), $filename);

                $audio = Audio::create([
                    'artist' => $request->input('artist'),
                    'name' => $request->input('name'),
                    'song' => $filename
                ]);

                if ($audio) {
                    return redirect()->route('audios.index', ['audio' => $audio->id])
                        ->with('success', 'Audio created');
                }
            }

            return back()->withInput()->with('error', 'Error creating');
        }
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audio $audio)
    {

    }

    public function searchAudio(Request $request){
        if($request->ajax()){
            $output = "";
            $audios = DB::table('audios')->where('name', 'LIKE', '%'.$request->searchAudio.'%')
                ->orWhere('artist', 'LIKE', '%'.$request->searchAudio.'%')->get();

            foreach ($audios as $key => $audio){
                $output .= '<li class="list-group-item">'. $audio->artist . " - " . $audio->name .
                    ' <a href="/audios/' . $audio->id .
                    '">View Details</a> | <a href="/audios/' . $audio->id  .
                    '/edit">Edit</a></li>';
            }

            return Response($output);
        }
    }
}
