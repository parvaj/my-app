<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessType extends Model
{
    use HasFactory;
    protected $table = 'business_types';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // public function businessList()
    // {
    //     return $this->hasMany(BusinessList::class);
    // }

}
