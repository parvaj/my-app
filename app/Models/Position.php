<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model 
{

    protected $table = 'positions';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}