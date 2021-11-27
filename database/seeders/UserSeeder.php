<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('users')->insert([
         'name' => 'Admin',
         'email' => 'root@gmail.com',
         'phone' => '88888888888',
         'password' => Hash::make('2341'),
         'admin' => true
      ]);
   }
}
