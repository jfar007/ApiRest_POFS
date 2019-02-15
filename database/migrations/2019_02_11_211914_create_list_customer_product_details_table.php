<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListCustomerProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {     
        Schema::create('list_customer_product_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('list_customer_product_id');
            $table->foreign('list_customer_product_id')
                    ->references('id')->on('list_customer_product')
                    ->onDelete('cascade');
            $table->unsignedInteger('product_id');        
            $table->foreign('product_id')
                    ->references('id')->on('product')
                    ->onDelete('cascade');
            $table->boolean('suggest')->default(false);                                        
            $table->integer('priority');
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('list_customer_product_details');
    }
}
