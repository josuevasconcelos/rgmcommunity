<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public $table = 'roles';

    protected $fillable = [
        'description',
    ];

    public function users(){
        return $this->hasMany('App\User');
    }

    public function functionalities(){
        return $this->belongsToMany('App\Functionality');
    }
}
