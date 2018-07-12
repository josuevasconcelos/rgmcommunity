<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if(Auth::check()){
            $users = User::paginate(5);

            return view('users.index', ['users'=> $users]);
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(Auth::check()){
            $user = User::find($user->id);

            return view('users.show', ['user'=>$user]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::check()){
            $user = User::find($user->id);

            return view('users.edit', ['user'=>$user]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Auth::check()){
            $userUpdate = User::where('id', $user->id)->update([
                'role_id' => $request->input('role_id'),
            ]);

            if($userUpdate){
                session()->flash('success_notification', 'User updated successfully');

                return redirect()->route('users.index');
            }
            else{
                session()->flash('error_notification', 'Error updating User');

                return redirect()->route('users.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function profile(){
        return view('profile', array('user' => Auth::user()));
    }

    public function updateAvatar(Request $request)
    {
        if(Auth::check()){
            if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->save( public_path('/uploads/avatars/' . $filename) );

                $user = Auth::user();
                $user->avatar = $filename;
                $user->save();
            }

            return view('profile', array('user' => Auth::user()));
        }
    }

    public function searchUser(Request $request){
        if($request->ajax()){
            $output = "";
            $users = DB::table('users')->where('name', 'LIKE', '%'.$request->searchUser.'%')
                ->orWhere('email', 'LIKE', '%'.$request->searchUser.'%')->get();

            if($users->count() == 0){
                $output .= '<ul class="list-group" id="error">
                                <li class="list-group-item" id="searchNotFoundText">Users not found</li>
                            </ul>';

                return Response($output);
            }

            if($users){
                $output .= '<ul class="list-group">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                foreach ($users as $key => $user){
                    $role = Role::find($user->role_id);

                    $output .= '<tr>
                                    <td>' . $user->id . '</td>
                                    <td>' . $user->name . '</td>
                                    <td>' . $user->email . '</td>
                                    <td>' . $role->description . '</td>
                                    <td class="buttonOnCenter">
                                        <button type="button" class="btn btn-primary btn-sm"><a class="textForButton" href="/users/' . $user->id . '">View User</a></button>
                                        <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/users/' . $user->id . '">Edit</a></button>
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
