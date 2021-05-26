<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ANTPaciente',
            'email' => 'antonio@gmail.com',
            'password' => Hash::make('123456789'),
            'cpf' => '31263219837'
        ]);
    }
}
