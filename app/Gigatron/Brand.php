<?php

namespace App\Gigatron;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'gigatron_brands';

    protected $guarded = [];

    protected $primaryKey = 'id';
    
    public $incrementing = false;

}
