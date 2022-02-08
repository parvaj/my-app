<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model 
{

    protected $table = 'assets';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}