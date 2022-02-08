<?php

namespace App/Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deduction extends Model 
{

    protected $table = 'deductions';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}