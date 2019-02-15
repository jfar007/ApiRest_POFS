<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');        
            $table->foreign('customer_id')
                    ->references('id')->on('customer')
                    ->onDelete('cascade');
            $table->unsignedInteger('branch_office_id');        
            $table->foreign('branch_office_id')
                    ->references('id')->on('branch_office')
                    ->onDelete('cascade');
            $table->string('description',150)->nullable();; 
            $table->double('total_quantity');
            $table->string('purchase_order_number',100)->nullable();; 
            $table->string('purchase_order_url',150)->nullable();; 
            $table->unsignedInteger('status_id');        
            $table->foreign('status_id')
                    ->references('id')->on('status')
                    ->onDelete('cascade');
            $table->unsignedInteger('users_create_id');
            $table->foreign('users_create_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->unsignedInteger('users_lm_id');
            $table->foreign('users_lm_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('purchase_order');
    }
}
