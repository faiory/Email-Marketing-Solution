<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function index(){
        return view('profile');
    }

    public function changePassword(Request $request){
        $valid = $request->validate([
            'password' => 'required|min:6'
        ]);
        if (!$valid) {
            dd($valid);
            return redirect('profile');    
        } else {
            // dd($valid);
            $user = Auth::user();
            $user->password = Hash::make($request->password1);
            $user->save();
            return redirect('profile');
        }
    }


}
