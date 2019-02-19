<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 8)->unique();   
            $table->string('password',100);
            $table->string('name',150);
            $table->string('email')->unique();
            $table->string('branch_office',100);
            $table->string('mobile_phone',20);
            $table->string('landline',10);
            $table->string('address',50);
            $table->string('latitude_longitude_elevation',150);
            $table->unsignedInteger('rol_id')->nullable();
            $table->foreign('rol_id')
                    ->references('id')->on('rol')
                    ->onDelete('cascade');
            $table->unsignedInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                    ->references('id')->on('customer')
                    ->onDelete('cascade');  
            $table->unsignedInteger('branch_office_cf_id')->nullable();        
            $table->foreign('branch_office_cf_id')
                    ->references('id')->on('branch_office')
                    ->onDelete('cascade');         
            $table->boolean('confirmed')->nullable()->default(0);
            $table->string('confirmation_code')->nullable();
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
        Schema::dropIfExists('users');
    }
}
