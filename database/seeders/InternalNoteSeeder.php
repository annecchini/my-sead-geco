<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternalNote;

class InternalNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //calling InternalNoteFactory
        InternalNote::factory()->count(100)->create();
    }
}
