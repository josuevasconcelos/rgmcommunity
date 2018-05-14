<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Difficultylevel extends Model
{
    public $table = 'difficultylevels';

    protected $fillable = [
        'description',
    ];

    public function projects(){
        return $this->hasMany('App\Project');
    }
}
