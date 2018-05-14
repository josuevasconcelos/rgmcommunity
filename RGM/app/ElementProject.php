<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElementProject extends Model
{

    public $table = 'element_project';

    protected $fillable = [
        'element_id',
        'project_id',
        'block',
        'line',
        'column',
    ];
}
