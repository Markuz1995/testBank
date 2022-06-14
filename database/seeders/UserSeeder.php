<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=1; $i < 4; $i++) { 

            DB::table('users')->insert([
                'name' => 'User'. $i,
                'id_card' => 123456789 + $i,
                'password' => Hash::make('1234'),
            ]);

        }
        
    }
}
