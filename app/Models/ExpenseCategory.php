<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model 
{

    protected $table = 'expense_categories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}