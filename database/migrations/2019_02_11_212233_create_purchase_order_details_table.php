<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('purchase_order_id');
            $table->foreign('purchase_order_id')
                    ->references('id')->on('purchase_order')
                    ->onDelete('cascade');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')
                    ->references('id')->on('product')
                    ->onDelete('cascade');
            $table->double('quantity');       
            $table->date('purchase_order_date');           
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
        Schema::dropIfExists('purchase_order_details');
    }
}
