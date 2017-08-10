<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function contractors()
    {
        return $this->belongsTo('App\Contractor');
    }
}
