<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// TODO
// THIS WILL BE CHANGED TO CLIENT
use App\Client;

class SubscriptionController extends Controller
{
    //
    //CREATE NEW USER
    public function unsubscribe($token)
    {
        if (Client::where('sub_token', $token)->exists()){
            $client = Client::where('sub_token', $token)->first();

            return view('unsubscribe', ['client' => $client->email]);
        } else {
            // WHEN NOT FOUND SHOW A 404 ERROR CODE PAGE
            // return "Not found";
            return abort(404);

        }
        
    }
}
