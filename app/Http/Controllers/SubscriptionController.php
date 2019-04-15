<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// TODO
// THIS WILL BE CHANGED TO CLIENT
use App\User;

class SubscriptionController extends Controller
{
    //
    //CREATE NEW USER
    public function unsubscribe($id)
    {
        // $user = new User();
        $user = User::find($id);
        // $email = User::find($id)->email;
        
        if (User::where('id', $id)->exists()){
            return view('unsubscribe', ['user' => $user]);
        } else {
            
            // WHEN NOT FOUND SHOW A 404 ERROR CODE PAGE
            return "User not found";
        }
        
    }
}
