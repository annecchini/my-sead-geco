<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Person;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User Fernando
        $user = new User();
        $user->id = 1;
        $user->person_id = 1;
        $user->email = 'fernando.void@gmail.com';
        $user->password = Hash::make('senhafraca123');
        $user->save();

        //User factory
        $people = Person::where('id', '!=', 1)->get();
        foreach ($people as $person) {
            // criar User apenas para as pessoas com id par
            if ($person->id % 2 == 0) User::factory()->count(1)->create(['person_id' => $person->id]);
        }
    }
}
