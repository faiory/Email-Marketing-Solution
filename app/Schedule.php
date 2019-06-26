<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    public function newsletter()
    {
        return $this->belongsTo('App\Newsletter');
    }
    public function subgroup()
    {
        return $this->belongsTo('App\Subgroup');
    }

}
