<?php

namespace App;

use app\Province;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function Province()
    {
        return $this->belongsTo('App\Province');
    }
}
