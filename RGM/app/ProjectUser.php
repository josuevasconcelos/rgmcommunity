<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{

    public $table = 'project_user';

    protected $fillable = [
        'project_id',
        'user_id',
        'profile_id',
    ];

    public function profile(){
        return $this->belongsTo('App\Profile');
    }

}
