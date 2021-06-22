<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::beginTransaction();
        try {
            Schema::create('people', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('cpf', 20);
                $table->timestamps();
            }); 
        
            DB::commit();

        //if error  
        } catch (\Exception $e) {
            DB::rollback();
            echo "Erro em 2021_06_16_135458_create_people_table.php up";
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
