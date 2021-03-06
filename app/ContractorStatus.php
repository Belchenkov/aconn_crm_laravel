<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractorStatus extends Model
{
    public function contractor() {
        return $this->belongsTo('App\Contractor');
    }
}
