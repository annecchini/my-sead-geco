<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('ocupation_id');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('pole_id')->nullable();
            $table->dateTime('begin');
            $table->dateTime('end');
            $table->text('notes')->nullable();
            $table->timestamps();

            //FKs
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('ocupation_id')->references('id')->on('ocupations');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('pole_id')->references('id')->on('poles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonds');
    }
}
