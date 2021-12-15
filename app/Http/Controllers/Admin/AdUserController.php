<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AdUserController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     // if(Gate::denies('loggedIn')) {

    //     // }

    //     if(Gate::allows('isAdmin')) {
    //         $users = User::paginate(10);
    //         return view('admin.users.index', ['users' => $users]);
    //     }
    //     else {
    //         return redirect()->route('home')->with('message', 'You must be an admin to access this page.');
    //     }
    // }

    public function indexAll()
    {


        if(Gate::allows('isAdmin')) {
            $users = User::paginate(10);
            return view('admin.users.indexall', ['users' => $users]);
        } else {
            return redirect()->route('home')->with('message', 'You must be logged in to access this page.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {if(Gate::allows('isAdmin')){
        return view('admin.users.create', ['roles' => Role::all()]);
    }else{
            return redirect()->route('home')->with('message', 'You must be an admin to create a new user.');
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
        if(Gate::allows('isAdmin')) {


            $validatedData = $request -> validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            $u = new User;
            $u -> name = $validatedData['name'];
            $u -> email = $validatedData['email'];
            $u -> password = Hash::make($validatedData['password']);
            $u->save();

            $u->roles()->sync($request->roles);
            return redirect()->route('admin.users.indexall');

        } else {
            return redirect()->route('home')->with('message', 'You must be an admin to create a new user.');
        }
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::allows('isAdmin')) {
            return view('admin.users.edit', ['user' => $user, 'roles' => Role::all()]);
        }
        else {
            return redirect()->route('home')->with('message', 'You must be an admin to access this page.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Gate::allows('isAdmin')) {
            $user->roles()->sync($request->roles);
            session() -> flash('message', 'User edited.');
            return redirect() -> route('admin.users.indexall');
        }
        else {
            return redirect()->route('home')->with('message', 'You must be an admin to access this page.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {


        if(Gate::allows('isAdmin')) {
            User::destroy($user->id);
            return redirect() -> route('admin.users.indexall');
        }
        else {
            return redirect()->route('home')->with('message', 'You must be an admin to delete a user.');
        }
    }
}
