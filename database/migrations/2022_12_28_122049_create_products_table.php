<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('name');
            $table->text('description');
            $table->integer('price');
            $table->unsignedInteger('vendor_id');
            $table->foreign('vendor_id')->references('vendor_id')->on('vendors');
            $table->boolean('status');
            $table->unsignedInteger('feature_image')->nullable();
            $table->foreign('feature_image')->references('image_id')->on('images');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
