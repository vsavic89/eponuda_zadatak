<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGigatronProductsBrandsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gigatron_brands', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->timestamps();

            $table->primary('id');
        });

        Schema::create('gigatron_products', function (Blueprint $table) {
            $table->integer('id');
            $table->string('ean')->nullable();
            $table->string('name');
            $table->decimal('price', 10, 3);
            $table->string('image_url')->nullable();
            $table->string('brand_id')->nullable();
            $table->timestamps();

            $table->primary('id');
            $table->foreign('brand_id')->references('id')->on('gigatron_brands')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gigatron_products');
        Schema::dropIfExists('gigatron_brands');        
    }
}
