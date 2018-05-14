<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{

    public $table = 'templates';

    protected $fillable = [
        'name',
        'numberOfColumns',
        'numberOfLines',
        'numberOfBlocks',
    ];

    public function projects(){
        return $this->hasMany('App\Project');
    }
}
