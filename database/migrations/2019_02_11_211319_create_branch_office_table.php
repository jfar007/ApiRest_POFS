<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_office', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('main_phone',20);
            $table->string('main_address',50);
            $table->string('latitude_longitude_elevation',150);
            $table->unsignedInteger('customer_id');        
            $table->foreign('customer_id')
                    ->references('id')->on('customer')
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
        Schema::dropIfExists('branch_office');
    }
}
