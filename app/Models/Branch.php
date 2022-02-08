<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model 
{
    protected $table = 'branches';
    public $timestamps = true;
    protected $fillable = ['title'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // public function businessList()
    // {
    //     return $this->hasMany('App\BusinessList');
    // }

}