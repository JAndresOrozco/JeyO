<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "users";

    public function users() {
        return $this->belongsToMany('App\User');
    }
}
