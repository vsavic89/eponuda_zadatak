<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGigatronBrandProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gigatron_brand_products', function (Blueprint $table) {
            $table->integer('product_id');
            $table->string('brand_id');
            $table->timestamps();

            $table->primary(['product_id', 'brand_id']);

            $table->foreign('product_id')->references('id')->on('gigatron_products')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('gigatron_brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gigatron_brand_products');
    }
}
