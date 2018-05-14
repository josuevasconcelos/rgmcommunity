<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    public $table = 'projects';

    protected $fillable = [
        'name',
        'difficultylevel_id',
        'type_id',
        'template_id',
        'audio_id',
        'user_id',
    ];

    public function audio(){
        return $this->belongsTo('App\Audio');
    }

    public function template(){
        return $this->belongsTo('App\Template');
    }

    public function type(){
        return $this->belongsTo('App\Type');
    }

    public function difficultylevel(){
        return $this->belongsTo('App\Difficultylevel');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function elements(){
        return $this->belongsToMany('App\Element');
    }
}
