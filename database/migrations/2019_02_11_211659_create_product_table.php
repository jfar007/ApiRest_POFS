<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_fs',20);
            $table->string('item',20);
            $table->string('name',40);
            $table->string('pronunciation_in_english',150);
            $table->string('description',150);
            $table->string('packsize',20);
            $table->string('picture_url',150);
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                    ->references('id')->on('category')
                    ->onDelete('cascade');
            $table->unsignedInteger('unit_id');
            $table->foreign('unit_id')
                    ->references('id')->on('unit')
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
        Schema::dropIfExists('product');
    }
}
