<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


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
        $user->email = 'fernando.void@gmail.com';
        $user->password = Hash::make('senhafraca123');
        $user->save();

    }
}
