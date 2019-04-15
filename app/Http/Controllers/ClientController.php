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
    
    // CREATE NEW USER
    public function store(Request $request)
    {
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
            $client->save();
            return redirect('clients');


            // foreach ($subgroups as $subgroup) {   
            //     if ($subgroup) 
            //     // CHECK IF THE SUBGROUP IS FULL OR NOT
            //     if (Client::where('subgroup_id', $subgroup->id)->count() < 2) {
            //         $client->subgroup_id = $subgroup->id;
            //         $client->save();
                    
            //         // return redirect('clients');
            //         return "should not create new subgroup";
            //     } else {
            //         // dd(Client::where('subgroup_id', $subgroup->id)->count());
            //         $newSub = new Subgroup();
            //         $newID = $subgroup->id + 1;
            //         $newSub->name = "subgroup {$newID}";
                    
            //         $newSub->save();
            //         $client->subgroup_id = $newID;
            //         $client->save();
            //         // return redirect('clients');
            //         return "should create a new subgroup";
            //     }
            // }
        }
    }


    // DELETE USER
    public function delete($id)
    {
        Client::destroy($id);
    }
    


    // For populating
    // public function createNew(){
    //     $user = new User();
    //     $user->password = Hash::make('123123');
    //     $user->email = 'abbas@gmail.com';
    //     $user->role_id = 1;
    //     $user->save();        
    // }
}
