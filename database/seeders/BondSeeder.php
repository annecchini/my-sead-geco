<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bond;

class BondSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Person Factory
        Bond::factory()->count(150)->create();
    }
}
