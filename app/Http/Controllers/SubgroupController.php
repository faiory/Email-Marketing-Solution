<?php

namespace App\Http\Controllers;
use App\Subgroup;
use App\Client;
use Illuminate\Http\Request;

class SubgroupController extends Controller
{
    //
    public function index(){
        $subgroups = Subgroup::paginate(4);
        return view('subgroups', ['subgroups' => $subgroups]);
    }
    
    public function modify(Request $request){
        
        // Validate the request...
        $validatedData = $request->validate([
            'name' => 'required|unique:subgroups|max:30'
        ]);

        if(!$validatedData){
            return redirect('subgroups');
        } else {
            $subgroup = Subgroup::find($request->id);
            $subgroup->name = $request->name;
            $subgroup->save();
            return redirect('subgroups');
        }
    }

    public function delete(Request $request){
        if (Subgroup::find($request->id)) {
            foreach (Client::where('subgroup_id', $request->id)->get() as $client) {
                Client::destroy($client->id);
            }
            
            //DELETE ALL SCHEDULES WITH THAT SUBGROUP
            foreach (Schedule::where('subgroup_id', $request->id)->get() as $schedule) {
                Schedule::destroy($schedule->id);
            }

            
            Subgroup::destroy($request->id);
            return redirect('subgroups');
        } else {
            $errors = [];
            array_push($errors, "Subgroup does not exist");   
            return view('errors.error', ['errors' => $errors]);
        }        
    }
    
}
