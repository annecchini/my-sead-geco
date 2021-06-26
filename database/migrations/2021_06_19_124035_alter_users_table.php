<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('name');
            $table->unsignedBigInteger('person_id')->after('id');

            //constraint
            $table->foreign('person_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::table('users', function(Blueprint $table){
                //remove contraint
                $table->dropForeign('users_person_id_foreign'); //[table]_[column]_foreign;
                
                $table->dropColumn('person_id');
                $table->string('name')->default('Lost on migration up...')->after('id');
                $table->string('name')->default(null)->change();
            });     
    }
}
