<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Person Fernando
        $person = new Person();
        $person->id = 1;
        $person->nome = 'Fernando Lyrio Annecchini';
        $person->cpf = '088.402.807-07';
        $person->save();
    }
}
