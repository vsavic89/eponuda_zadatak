<?php

namespace App\Gigatron;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'gigatron_products';

    protected $guarded = [];

    protected $primaryKey = 'id';
    
    public $incrementing = false;

}
