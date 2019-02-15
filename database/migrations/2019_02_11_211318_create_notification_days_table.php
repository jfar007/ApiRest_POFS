<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificationdays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day',20);
            $table->smallInteger('until_this_time');
            $table->boolean('send_notification')->default(false);
            $table->boolean('active')->default(false);
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')->on('customer')
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
        Schema::dropIfExists('notificationdays');
    }
}
