<?php

namespace App;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    //
    public $table = 'audios';

    protected $fillable = [
        'name',
        'artist',
        'song',
    ];

    public function projects(){
        return $this->hasMany('App\Project');
    }
}
