<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Product', function (Blueprint $table) {
            $table->id();
            $table->string('Product_Code', 18)->unique();
            $table->string('Product_Name', 30);
            $table->integer('Price');
            $table->string('Currency', 5);
            $table->integer('Discount');
            $table->string('Dimension', 50);
            $table->string('Unit', 5);
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
        Schema::dropIfExists('product');
    }
}
