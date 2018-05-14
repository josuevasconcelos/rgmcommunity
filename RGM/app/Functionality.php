<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Functionality extends Model
{

    public $table = 'functionalities';

    protected $fillable = [
        'description',
        'url',
    ];

    public function roles(){
        return $this->belongsToMany('App\Role');
    }
}
