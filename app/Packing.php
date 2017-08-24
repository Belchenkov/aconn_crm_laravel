<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    public function contractor() {
        return $this->belongsTo('App\Contractor');
    }
}
