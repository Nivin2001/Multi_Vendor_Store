<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
         'name' => 'Nivin Shabat',
         'email' =>'nivin20012001@gmail.com',
         'password' => Hash::make('password'),
         'phone_number' => '0595517216' ,
        ]);
        DB::table('users')->insert([
            'name' => 'salwa Shabat',
            'email' =>'salwa@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '0595517215' ,
           ]);


    }
}
