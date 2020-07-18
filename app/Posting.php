<?php

namespace App;

use Auth;
use app\User;
use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    protected $fillable = ['id_user', 'owner', 'img', 'name', 'age', 'category', 'size', 'sex', 'background', 'description', 'medical', 'vaccinated', 'neutered', 'friendly', 'date', 'location', 'status'];

    protected $attributes = [
        'status' => 'Tersedia',
    ];

    // Disable timestamps
    public $timestamps = false;
}
