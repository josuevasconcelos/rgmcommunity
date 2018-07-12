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
        if(Auth::check()){
            $audios = Audio::paginate(5);

            return view('audios.index', ['audios'=> $audios]);
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
            return view('audios.create');
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
                    session()->flash('success_notification', 'Audio created successfully');

                    return redirect()->route('audios.index');
                } else {
                    session()->flash('error_notification', 'Error creating Audio');

                    return redirect()->route('audios.index');
                }
            }
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
        if(Auth::check()){
            $audio = Audio::find($audio->id);

            return view('audios.show', ['audio'=>$audio]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function edit(Audio $audio)
    {
        if(Auth::check()){
            $audio = Audio::find($audio->id);

            return view('audios.edit', ['audio'=>$audio]);
        }
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
        if(Auth::check()) {
            if ($request->hasFile('song')) {
                $song = $request->file('song');
                $filename = time() . '.' . $song->getClientOriginalExtension();
                $song->move(public_path('/uploads/audios'), $filename);

                $audio = Audio::where('id', $audio->id)->update([
                    'artist' => $request->input('artist'),
                    'name' => $request->input('name'),
                    'song' => $filename
                ]);

                if ($audio) {
                    session()->flash('success_notification', 'Audio updated successfully');

                    return redirect()->route('audios.index');
                } else {
                    session()->flash('error_notification', 'Error updating Audio');

                    return redirect()->route('audios.index');
                }
            }
        }
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

            if($audios->count() == 0){
                $output .= '<ul class="list-group" id="error">
                                <li class="list-group-item" id="searchNotFoundText">Audios not found</li>
                            </ul>';

                return Response($output);
            }

            if($audios){

                $output .= '<ul class="list-group">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Artist</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                foreach ($audios as $key => $audio){
                    $output .= '<tr>
                                    <td>' . $audio->id . '</td>
                                    <td>' . $audio->artist . '</td>
                                    <td>' . $audio->name . '</td>
                                    <td class="buttonOnCenter">
                                        <button type="button" class="btn btn-primary btn-sm"><a class="textForButton" href="/audios/' . $audio->id . '">Listen Audio</a></button>
                                        <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/audios/' . $audio->id . '">Edit</a></button>
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
