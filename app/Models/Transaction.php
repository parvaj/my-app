<?php

namespace App/Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model 
{

    protected $table = 'bank_transactions';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}