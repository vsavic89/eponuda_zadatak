<?php

namespace App\Gigatron;

use Illuminate\Database\Eloquent\Model;

class BrandProduct extends Model
{
    protected $table = 'gigatron_brand_products';

    protected $guarded = [];

    protected $primaryKey = ['product_id', 'brand_id'];

    public $incrementing = false;

}
