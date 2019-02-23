<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->double('price');
            $table->boolean('discount');
            $table->string('discount_price');
            $table->string('thumbnail');
            $table->text('size_options')->nullable();
            $table->text('size_values')->nullable();
            $table->text('size_prices')->nullable();
            $table->text('color_options')->nullable();
            $table->text('color_values')->nullable();
            $table->text('color_prices')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
}
