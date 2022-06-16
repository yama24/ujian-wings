<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transaction_Detail', function (Blueprint $table) {
            $table->id();
            $table->string('Document_Code', 3);
            $table->string('Document_Number', 10);
            $table->string('Product_Code', 18);
            $table->integer('Price');
            $table->integer('Quantity');
            $table->string('Unit', 5);
            $table->integer('Sub_Total');
            $table->string('Currency', 5);
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
        Schema::dropIfExists('_transaction__detail');
    }
}
