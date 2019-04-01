<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Role;


class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */

    public $defaultPassword = "123";
    
    public function index()
    {
        $users = User::all()->reverse();
        return view('users', ['users' => $users]);
    }
    
    // public function show()
    // {
        // $users = User::where('id', '')all()->orderBy('id', 'desc');

        // Role::find($user->role_id)->name;

        // return view('users', ['users' => $users]);
    // }
    
    // CREATE NEW USER
    public function store(Request $request)
    {
        // Validate the request...

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($this->defaultPassword);
        $user->role_id = $request->roleId;
        $user->save();
        return redirect('users');
    }

    // For populating
    public function createNew(){
        $user = new User();
        $user->password = Hash::make('123123');
        $user->email = 'abbas5@gmail.com';
        $user->role_id = 1;
        $user->save();        
    }
}
