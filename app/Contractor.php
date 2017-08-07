<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User');
    }
    public function region()
    {
        return $this->hasOne('App\Region');
    }

    public function status()
    {
        return $this->hasOne('App\ContractorStatus');
    }
}
