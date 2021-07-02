<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
	        $table->string('name',150);
	        $table->string('slug',170);
	        $table->string('product_code',20)->nullable()->default('');
	        $table->boolean('is_product')->default(false);
	        $table->boolean('is_material')->default(false);
	        $table->decimal('price_buy')->unsigned()->default(0);
	        $table->decimal('price_sale')->unsigned()->default(0);
	        $table->boolean('status')->default(true);
	
	        $table->integer('category_id')->unsigned();
	        $table->foreign('category_id')->references('id')->on('categories');
	
	        $table->integer('unit_id')->unsigned();
	        $table->foreign('unit_id')->references('id')->on('units');
	
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
}