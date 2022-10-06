<?php

namespace Database\Seeders;

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
        //User::factory()->times(10)->create();
        DB::table('users')->insert([
            ['name'=>'Admin','email'=>'admin@gmail.com','username'=>'admin',"password"=>Hash::make('246357@'),'status'=>1],
            ['name'=>'Guest','email'=>'guest@gmail.com','guest'=>'guest',"password"=>Hash::make('246357@'),'status'=>1],
        ]);
    }
}
