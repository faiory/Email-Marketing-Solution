<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $table = 'clients';
    
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function subgroup()
    {
        return $this->belongsTo('App\Subgroup');
    }
}
