<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_management', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('task_id');
            $table->foreign('task_id')
            ->references('id')->on('task')
            ->onDelete('cascade');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')
            ->references('id')->on('customer')
            ->onDelete('cascade');

            $table->date('from',40);
            $table->String('name_of_day',40);
            $table->time('hour_of_day');
            $table->boolean('notify')->default(false);
            $table->String('initial_day_notify',40);
            $table->time('notify_from');
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
        Schema::dropIfExists('order_management');
    }
}
