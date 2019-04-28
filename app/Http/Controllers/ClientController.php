<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Status;
use App\Subgroup;

class ClientController extends Controller
{

    public function index()
    {
        // Client::paginate(5);
        $clients = Client::paginate(5);
        $statuses = Status::All();
        return view('clients', ['clients' => $clients, 'statuses' => $statuses]);
    }
    
    // GENREATE RANDOM CODE USED FOR SUBSCRIBING AND UNSUBSCRIBING
    

    // CREATE NEW USER
    public function store(Request $request)
    {
        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        // Validate the request...
        $validatedData = $request->validate([
            'email' => 'required|unique:clients|max:30',
            'status_id' => 'required:clients|max:30'
        ]);

        if(!$validatedData){
            return redirect('clients');
        } else {
            if (Subgroup::count() === 0) {
                $newSubgroup = new Subgroup();
                $newSubgroup->name = "Subgroup 1";
                $newSubgroup->save();
                // return redirect('clients');
            }
            $subgroupIdToBeUsed = "";
            
            $subgroups = Subgroup::All();
            foreach ($subgroups as $subgroup) {
                if (Client::where('subgroup_id', $subgroup->id)->count() < 2) {
                    $subgroupIdToBeUsed = $subgroup->id;
                    break;
                }
            }
            if ($subgroupIdToBeUsed == null) {
                $subgroupIdToBeUsed = Subgroup::max('id');
                $subgroupIdToBeUsed++;
                // CREATE NEW SUBGROUP
                $newSub = new Subgroup();
                $newSub->name = "Subgroup {$subgroupIdToBeUsed}";
                $newSub->save();
            }
            $client = new Client();
            $client->email = $request->email;
            $client->status_id = $request->status_id;
            $client->subgroup_id = $subgroupIdToBeUsed;
            
            // 
            $token = generateRandomString();
            while (Client::where('sub_token', $token)->first() != null) {
                $token = generateRandomString();
            }
            $client->sub_token = $token;
            // 

            
            $client->save();
            
            return redirect('clients');
        }
    }


    // DELETE USER
    public function delete($id)
    {
        Client::destroy($id);
        return redirect('clients');
    }
}
