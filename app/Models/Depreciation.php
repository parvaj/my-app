<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Depreciation extends Model 
{

    protected $table = 'asset_depreciations';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}