<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class SubscriptionController extends Controller
{
    //
    //CREATE NEW USER
    public function unsubscribe($token)
    {
        if (Client::where('sub_token', $token)->exists()){
            $client = Client::where('sub_token', $token)->first();
            if ($client->status_id == 1) {
                $client->status_id = 2;
                $client->save();
            } else {
                $client->status_id = 1;
                $client->save();
            }
            if ($client->status_id == 1) {
                \Mail::to($client)->send(new WelcomeClient($client));
                return "<script>window.close();</script>";
            } else {
                return view('unsubscribe', ['client' => $client->email]);
            }
        } else {
            return abort(404);
        }
        
    }
}
