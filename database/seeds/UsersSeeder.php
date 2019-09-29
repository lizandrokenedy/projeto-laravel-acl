<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\User::firstOrCreate(['email'=>'admin@gmail.com'], [
            'name'=>'Administrador',
            'password'=>Hash::make('123456')
        ]);
    }
}
