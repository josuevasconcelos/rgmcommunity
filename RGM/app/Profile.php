<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    public $table = 'profiles';

    protected $fillable = [
        'name',
        'description',
    ];

    public function project_users(){
        return $this->hasMany('App\ProjectUser');
    }
}
