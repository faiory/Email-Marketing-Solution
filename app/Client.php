<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Status;
use App\Subgroup;

class Client extends Model
{
    public static $importedCount;
    public static $errorCount = 0;
    protected $table = 'clients';
    
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function subgroup()
    {
        return $this->belongsTo('App\Subgroup');
    }
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function insertData($data){
        $subgroupIdToBeUsed = "";
        if (Subgroup::count() == 0) {
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
        }
        $client = new Client();
        $client->email = $data['email'];
        $client->status_id = 1;
        $client->subgroup_id = $subgroupIdToBeUsed;
        $token = Client::generateRandomString();

        while (Client::where('sub_token', $token)->first() != null) {
            $token = generateRandomString();
        }
        $client->sub_token = $token;
        
        $count = Client::where('email', $data['email'])->count();
        if($count == 0){
            //VALIDATE EMAIL
            if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $client->save();
                Client::$importedCount++;    
            }
            else {
                Client::$errorCount++;    
            }
        } else {
            Client::$errorCount++;
        }
    }    
}
