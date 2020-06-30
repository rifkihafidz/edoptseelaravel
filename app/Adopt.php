<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adopt extends Model
{
    protected $fillable = ['id_user', 'id_owner', 'id_adopter', 'id_post', 'id_application', 'adoptedat'];
}
