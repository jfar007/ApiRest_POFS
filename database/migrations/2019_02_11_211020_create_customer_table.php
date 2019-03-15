<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('main_phone',20);
            $table->string('main_address',50);
            $table->string('logo_url',150);
            $table->unsignedInteger('profile_id');
            $table->foreign('profile_id')
                ->references('id')->on('profile')
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
        Schema::dropIfExists('customer');
    }
}
