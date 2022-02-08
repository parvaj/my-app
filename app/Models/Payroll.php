<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model 
{

    protected $table = 'payrolls';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}