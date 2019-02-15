<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_rol', function (Blueprint $table) {
            $table->unsignedInteger('rol_id');
            $table->foreign('rol_id')
                ->references('id')->on('rol')
                ->onDelete('cascade');
            $table->unsignedInteger('section_id');
            $table->foreign('section_id')
                ->references('id')->on('section')
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
        Schema::dropIfExists('sectiosrol');
    }
}
