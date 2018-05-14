<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    public $table = 'elements';

    protected $fillable = [
        'name',
        'image',
        'animation',
    ];

    public function projects(){
        return $this->belongsToMany('App\Project');
    }
}
