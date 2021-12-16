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
    /**
     * Displays all users.
     *
     * @return \Illuminate\Http\Response
     */
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
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if(Gate::allows('isAdmin')) {
            return view('admin.users.create', ['roles' => Role::all()]);
        } else{
            return redirect()->route('home')->with('message', 'You must be an admin to create a new user.');
        }
    }

    /**
     * Store a newly created user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::allows('isAdmin')) {
            $validatedData = $request -> validate([
                'name' => 'required',
                'email' => 'required|email',
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

    /**
     * Show the form for editing a user.
     *
     * @param  User $user
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
     * Update a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Gate::allows('isAdmin')) {
            $user->roles()->sync($request->roles);
            session() -> flash('message', 'User edited.');
            return redirect() -> route('admin.users.indexall');
        } else {
            return redirect()->route('home')->with('message', 'You must be an admin to access this page.');
        }
    }

    /**
     * Remove a user.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::allows('isAdmin')) {
            User::destroy($user->id);
            return redirect() -> route('admin.users.indexall');
        } else {
            return redirect()->route('home')->with('message', 'You must be an admin to delete a user.');
        }
    }
}
