<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'address',
        'cellphoneNumber',
        'country',
        'communityRGM',
        'picture',
        'otherInformation',
        'status',
        'typeOfPatient',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projectss(){
        return $this->hasMany('App\Project');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function projects(){
        return $this->belongsToMany('App\Project');
    }
}
