<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('last_up_person_id');
            $table->string('model_name');
            $table->unsignedBigInteger('model_id');
            $table->text('content');
            $table->timestamps();

            //FKs
            $table->foreign('last_up_person_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_notes');
    }
}
