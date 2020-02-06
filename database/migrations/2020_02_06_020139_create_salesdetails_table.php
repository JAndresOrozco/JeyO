<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesdetails', function (Blueprint $table) {
            $table->bigIncrements('id_saledetail');
            $table->date('date');
            $table->bigInteger('quantity');
            $table->float('price');
            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id')->references('id_product')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salesdetails');
    }
}
