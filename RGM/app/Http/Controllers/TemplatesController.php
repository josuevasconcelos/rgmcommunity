<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $templates = Template::paginate(5);

            return view('templates.index', ['templates'=> $templates]);
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
            return view('templates.create');
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
            $template = Template::create([
                'name' => $request->input('name'),
                'numberOfColumns' => $request->input('numberOfColumns'),
                'numberOfLines' => $request->input('numberOfLines'),
                'numberOfBlocks' => $request->input('numberOfBlocks'),
            ]);

            if ($template) {
                session()->flash('success_notification', 'Template created successfully');

                return redirect()->route('templates.index');
            } else {
                session()->flash('error_notification', 'Error creating Template');

                return redirect()->route('templates.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        if(Auth::check()){
            $template = Template::find($template->id);

            return view('templates.show', ['template'=>$template]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        if(Auth::check()){
            $template = Template::find($template->id);

            return view('templates.edit', ['template'=>$template]);
        }
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
        if(Auth::check()){
            $templateUpdate = Template::where('id', $template->id)->update([
                'name' => $request->input('name'),
                'numberOfColumns' => $request->input('numberOfColumns'),
                'numberOfLines' => $request->input('numberOfLines'),
                'numberOfBlocks' => $request->input('numberOfBlocks'),
            ]);

            if($templateUpdate){
                session()->flash('success_notification', 'Template updated successfully');

                return redirect()->route('templates.index');
            }
            else{
                session()->flash('error_notification', 'Error updating Template');

                return redirect()->route('templates.index');
            }
        }
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

    public function searchTemplate(Request $request){
        if($request->ajax()){
            $output = "";
            $templates = DB::table('templates')->where('name', 'LIKE', '%'.$request->searchTemplate.'%')->get();

            if($templates->count() == 0){
                $output .= '<ul class="list-group" id="error">
                                <li class="list-group-item" id="searchNotFoundText">Templates not found</li>
                            </ul>';

                return Response($output);
            }

            if($templates){
                $output .= '<ul class="list-group">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Blocks</th>
                                            <th>Columns</th>
                                            <th>Lines</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                foreach ($templates as $key => $template){
                    $output .= '<tr>
                                    <td>' . $template->id . '</td>
                                    <td>' . $template->name . '</td>
                                    <td>' . $template->numberOfBlocks . '</td>
                                    <td>' . $template->numberOfColumns . '</td>
                                    <td>' . $template->numberOfLines . '</td>
                                    <td class="buttonOnCenter">
                                        <button type="button" class="btn btn-primary btn-sm"><a class="textForButton" href="/templates/' . $template->id . '">View Template</a></button>
                                        <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/templates/' . $template->id . '">Edit</a></button>
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

    public function getTotalOfTemplates(Request $request){
        if($request->ajax()){
            $count = DB::table('templates')->count();

            return Response($count);
        }
    }

    public function getNumberOfColumns(Request $request){
        if($request->ajax()){
            $templates = DB::table('templates')->where('id', '=', $request->getNumberOfColumns)->get();
            $numberOfColumns = $templates[0]->numberOfColumns;

            return Response($numberOfColumns);
        }
    }

    public function getNumberOfLines(Request $request){
        if($request->ajax()){
            $templates = DB::table('templates')->where('id', '=', $request->getNumberOfLines)->get();
            $numberOfLines = $templates[0]->numberOfLines;

            return Response($numberOfLines);
        }
    }

    public function getNumberOfBlocks(Request $request){
        if($request->ajax()){
            $templates = DB::table('templates')->where('id', '=', $request->getNumberOfBlocks)->get();
            $numberOfBlocks = $templates[0]->numberOfBlocks;

            return Response($numberOfBlocks);
        }
    }
}
