<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdditionalExpense extends Model 
{

    protected $table = 'asset_additional_expenses';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}