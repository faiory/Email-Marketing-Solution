<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Status;
use App\Subgroup;
use App\Mail\WelcomeClient;
use Session;


class ClientController extends Controller
{

    public function index()
    {
        // Client::paginate(5);
        $clients = Client::paginate(5);
        $statuses = Status::All();
        return view('clients', ['clients' => $clients, 'statuses' => $statuses]);
    }
    
    public function upload(Request $request) {
        $validatedData = $request->validate([
            'clientsFile' => 'required'
        ]);
        
        if(!$validatedData){
            return redirect('clients');
        } else {
            $file = $request->file('clientsFile');
            $fileSize = $file->getSize();

            if ($request->input('importBtn') != null ){
                $file = $request->file('clientsFile');
                $fileSize = $file->getSize();
                $valid_extension = array("csv");
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                // 2MB in Bytes
                $maxFileSize = 2097152; 
                
                Client::$importedCount = 0;
                Client::$errorCount = 0;
                if(in_array(strtolower($extension),$valid_extension)){
                    if($fileSize <= $maxFileSize){
                        // File upload location
                        $location = 'uploads'; 
                        
                        // Upload file 
                        $file->move($location,$filename); 
                        
                        // Import CSV to Database
                        $filepath = public_path($location."/".$filename);
    
                        $file = fopen($filepath,"r");
                        $importData_arr = array();
                        $i = 0;
                        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                            $num = count($filedata );
                            
                            // Skip first row (Remove below comment if you want to skip the first row)
                            /*if($i == 0){
                               $i++;
                               continue; 
                            }*/
                            for ($c=0; $c < $num; $c++) {
                               $importData_arr[$i][] = $filedata [$c];
                            }
                            $i++; 
                        }
                        fclose($file);
                         
                        // Insert to MySQL database
                        foreach($importData_arr as $importData){
                            $insertData = array(
                                "email"=>$importData[0]
                            );
                            Client::insertData($insertData);
                        }
                        $imports = Client::$importedCount;
                        $errorsCount = Client::$errorCount;

                        Session::flash('message',"Import Successful. Imported succefully: {$imports} | Failed imports: {$errorsCount} | Total records: {$i} ");
                    } else {
                        Session::flash('messageE','File too large. File must be less than 2MB.');  
                    }
                } else {
                    Session::flash('messageE','Invalid File Extension.');
                }
            } else {
                return redirect('clients');
            }
            return redirect('clients');
        }
    }

    
    public function search(Request $request){
        if($request->ajax()) {
            $output="";
            if($request->search == ""){
                return Response($output);
            }
            $clients = Client::where('email','LIKE','%'.$request->search."%")->get()->take(4);
            if($clients) {
                foreach ($clients as $client) {
                    $output .= "<tr id='$client->id'>";
                    $output .= "<td>$client->id</td>";
                    $output .= "<td>";
                    $output .= "<div class='input-group'>";
                    $output .= "<input type='email' name='' class='form-control clientEmail' placeholder='Email' value='$client->email'>";
                    $output .= "</div>";
                    $output .= "</td>";
                    $output .= "<td>";
                    $output .= $client->subgroup->name;
                    $output .= "</td>";
                    $output .= "<td>";
                    $output .= $client->status->name;
                    $output .= "</td>";
                    $output .= "<td>";
                    $output .= "$client->created_at";
                    $output .="</td>";
                    $output .= "<td>";
                    $output .= "<button class='updateBtn'>Update</button>";
                    $output .= "</td>";
                    $output .= "<td>";
                    $output .= "<button class='deleteBtn'>Delete</button>";
                    $output .= "</td>";
                    $output .= "</tr>";
                }
                return Response($output);
            }
        }
    }
    
    

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
            
            $subgroupIdToBeUsed = "";
            if (Subgroup::count() === 0) {
                $newSubgroup = new Subgroup();
                $newSubgroup->name = "Subgroup 1";
                $newSubgroup->save();
                $newSubgroup->name = "Subgroup {$newSubgroup->id}";
                $subgroupIdToBeUsed = $newSubgroup->id;
            }
            
            
            $subgroups = Subgroup::All();
            foreach ($subgroups as $subgroup) {
                if (Client::where('subgroup_id', $subgroup->id)->count() < 2) {
                    $subgroupIdToBeUsed = $subgroup->id;
                    break;
                }
            }

            if ($subgroupIdToBeUsed == null) {

                $subgroupIdToBeUsed = Subgroup::orderBy('created_at', 'desc')->first()->id;
                $subgroupIdToBeUsed++;
                // CREATE NEW SUBGROUP
                $newSub = new Subgroup();
                $newSub->name = "Subgroup {$subgroupIdToBeUsed}";
                $newSub->save();
                $subgroupIdToBeUsed = $newSub->id;
                // $newSub->name = "Subgroup {$newSub->id}";
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

            // IF INITIAL STATUS IS SUBSCRIBED
            return redirect('clients');
        }
    }
    public function modify(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|unique:clients|max:40',
            'id' => 'required'
        ]);

        if(!$validatedData){
            return redirect('clients');
        } else {
            if(filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $client = Client::find($request->id);
                $client->email = $request->email;
                $client->save();
                return redirect('clients');    
            } else {
                Session::flash('messageE','Incorrect email format');  
                return redirect('clients');    
            }

            
        }
    }
    public function delete(Request $request){
        $validatedData = $request->validate([
            'id' => 'required'
        ]);

        if(!$validatedData){
            return redirect('clients');
        } else {
            Client::destroy($request->id);
            return redirect('clients');
        }
    }

    // public function update($id, $email)
    // {
    //     if($client = Client::find($id)) {
    //         if ($client->email == $email) {
    //             return redirect('clients');
    //         }
    //         if (Client::where('email', $email)->exists()) {
    //             $errors = [];
    //             array_push($errors, "The email address is already taken");
    //             return view('errors.error', ['errors' => $errors]);
    //         } else {
    //             $client->email = $email;
    //             $client->save();    
    //             return redirect('clients');
    //         }
    //     }
    // }

    // DELETE USER
    // public function delete($id)
    // {
    //     if (Client::find($id)) {
    //         Client::destroy($id);
    //         return redirect('clients');
    //     } else {
    //         $errors = [];
    //             array_push($errors, "Client doesnt exist");
    //             return view('errors.error', ['errors' => $errors]);
    //     }
        
    // }
}
