<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    public function user()
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

    public function contacts()
    {
        return $this->hasOne('App\Contact');
    }

    public function contactor_status()
    {
        return $this->hasOne('App\ContractorStatus');
    }

    public function periodicity()
    {
        return $this->hasOne('App\Periodicity');
    }

    public function packing()
    {
        return $this->hasOne('App\Packing');
    }
}
