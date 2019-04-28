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
        // $photos = Photo::where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(10);

        $users = User::paginate(5);
        // $users = User::all()->reverse();
        return view('users', ['users' => $users]);
    }
    
    // CREATE NEW USER
    public function store(Request $request)
    {
        // Validate the request...
        $validatedData = $request->validate([
            'email' => 'required|unique:users|max:30'
        ]);

        if(!$validatedData){
            return redirect('users');
        } else {
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($this->defaultPassword);
            $user->role_id = $request->roleId;
            $user->save();
            return redirect('users');
        }
    }
    public function update($id, $email, $role)
    {
        if($user = User::find($id)) {
            $user->email = $email;
            $user->role_id = $role;
            $user->save();    
            return redirect('users');
        }
        
        if (User::where('email', $email)->exists() && (User::find($id)->role_id == $role)) {
            return "The email address is already taken";
        } else {
            return redirect('users');
            
        }
    }

    // DELETE USER
    public function delete($id)
    {
        User::destroy($id);
        return redirect('users');
    }
    


    // For populating
    public function createNew(){
        $user = new User();
        $user->password = Hash::make('123123');
        $user->email = 'abbas@gmail.com';
        $user->role_id = 1;
        $user->save();        
    }
}
