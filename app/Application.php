<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['id_user', 'id_post', 'phone', 'reason', 'otheranimals', 'permissions', 'apply_date', 'location'];

    protected $attributes = [
        'status' => '0',
    ];
}
