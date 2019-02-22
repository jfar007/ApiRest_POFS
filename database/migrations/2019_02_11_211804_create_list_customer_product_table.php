<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListCustomerProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_customer_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('description',100);
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')
                    ->references('id')->on('customer')
                    ->onDelete('cascade');
            $table->unsignedInteger('users_lm_id')->nullable();
            $table->foreign('users_lm_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('list_customer_product');
    }
}
