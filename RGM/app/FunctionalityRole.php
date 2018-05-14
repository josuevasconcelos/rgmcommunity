<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FunctionalityRole extends Model
{

    public $table = 'functionality_role';

    protected $fillable = [
        'functionality_id',
        'role_id',
    ];
}
