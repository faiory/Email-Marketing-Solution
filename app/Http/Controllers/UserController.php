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
            'email' => 'required|unique:users|max:30',
            'email' => 'regex:^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(maroonfrog)\.com$^'
        ]);
        // 'email' => 'regex:^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(maroonfrog)\.com$'
        
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

    public function search(Request $request){
        if($request->ajax()) {
            $output="";
            if($request->search == ""){
                return Response($output);
            }
            $users = User::where('email','LIKE','%'.$request->search."%")->get()->take(4);
            if($users) {
                foreach ($users as $user) {
                    $output.=
                    "<tr id='$user->id'>";
                    $output.= "<td>$user->id</td>";
                    $output.= "<td>";
                    $output.= "<div class='input-group'>";
                    $output.= "<input type='email' name='' class='form-control userEmail' placeholder='Email' value='$user->email'>";
                    $output.= "</div>";
                    $output.= "</td>";
                    $output.= "<td>";
                    $output.= "<div class='form-group'>";
                    $output.= "<select class='userRole' name='' class='form-control' id='sel123'>";
                                
                    if ($user->role_id == 1) {
                        $output.= "<option value='1'>Admin</option>";
                        $output.= "<option value='2'>Employee</option>";
                    } else {
                        $output.= "<option value='2'>Employee</option>";
                        $output.= "<option value='1'>Admin</option>";
                    }
                    $output.= "</select>";
                    $output.= "</div>";
                    $output.= "</td>";
                    $output.= "<td>";
                    $output.= "<button class='updateBtn'>Update</button>";
                    // A PROBLEM MIGHT OCCUR HERE
                    $output.= "</td>";
                    $output.= "<td>";
                    $output.="<button class='deleteBtn'>Delete</button>";
                    $output.= "</td>";
                    $output.= "</tr>";
                }
                return Response($output);
            }
        }
    }

    // public function update($id, $email, $role)
    // {
    //     if($user = User::find($id)) {
    //         if ($user->email == $email) {
    //             return redirect('users');
    //         }
    //         if (User::where('email', $email)->exists() && (User::find($id)->role_id == $role)) {
    //             $errors = [];
    //             array_push($errors, "The email address is already taken");
    //             return view('errors.error', ['errors' => $errors]);
    //         } else {
                
    //             if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //                 function checkEmail($email) {
    //                     $find1 = strpos($email, '@');
    //                     $find2 = strpos($email, 'maroonfrog.com');
    //                     return ($find1 !== false && $find2 !== false && $find2 > $find1);
    //                 }

    //                 if ( checkEmail($email) ) {
    //                     $user->email = $email;
    //                     $user->role_id = $role;
    //                     $user->save();    
    //                     return redirect('users');
    //                 }
    //             }
    //             else {
    //                 //NOT AN EMAIL
    //             }
    //         }
    //     }
    // }

    // DELETE USER
    public function delete(Request $request)
    {
        // Validate the request...
        $validatedData = $request->validate([
            'id' => 'required'
        ]);

        if(!$validatedData){
            return redirect('users');
        } else {
            if (User::find($request->id)) {
                User::destroy($request->id);
                return redirect('users');
            } else {
                $errors = [];
                    array_push($errors, "User doesnt exist");
                    return view('errors.error', ['errors' => $errors]);
            }   
            return redirect('users');
        }
    }
    
    public function modify(Request $request){
        
        // Validate the request...
        $validatedData = $request->validate([
            'email' => 'required|unique:users|max:30',
            'email' => 'regex:^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(maroonfrog)\.com$^',
            'id' => 'required',
            'role_id' => 'required'
        ]);

        if(!$validatedData){
            return redirect('users');
        } else {
            if(User::find($request->id)) {
                $user = User::find($request->id);
                $user->email = $request->email;
                $user->role_id = $request->role_id;
                $user->save();
            } 
            return redirect('users');
        }
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
